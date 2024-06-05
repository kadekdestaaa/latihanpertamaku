<?php
$id = $_GET['id'];

include "koneksi.php";
if(isset($_POST['judul'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['Deskripsi'];
    $albumid = $_POST['albumid'];
    $tanggal = $_POST['tanggal'];
    $userid = $_SESSION['user']['userid'];
    
    $query = mysqli_query($koneksi, "UPDATE foto set judul='$judul',Deskripsi='$deskripsi',albumid='$albumid',tanggal='$tanggal',userid='$userid' WHERE fotoid=$id");
    
    $gambar = $_FILES['gambar'];

    if($gambar['name'] != "") {

        
        $nama_gambar = $gambar['name'];
        move_uploaded_file($gambar['tmp_name'], 'gambar/'.$gambar['name']);
        $query = mysqli_query($koneksi, "UPDATE foto set gambar='$nama_gambar' WHERE fotoid=$id");
    
    }
    
    
    if ($query > 0) {
        echo '<script>alert("ubah Data Berhasil");</script>';
    
    }else{
        echo '<script>alert("ubah Data Gagal");</script>';
    }
}

$query = mysqli_query($koneksi, "SELECT*FROM foto WHERE fotoid=$id");
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
        <h1 class="mt-4">Galeri Foto</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Galeri Foto</li>
        </ol>
        <a href="galeri.php" class="btn btn-danger">Kembali</a>
        <form method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td width="200">Judul</td>
                    <td width="1">:</td>
                    <td><input type="text" name="judul" value="<?php echo $data['judul']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td><input type="text" name="Deskripsi" value="<?php echo $data['Deskripsi']; ?>"class="form-control"></td>
                </tr>
                <tr>
                    <td>Album</td>
                    <td>:</td>
                    <td>
                        <select name="albumid" class="form-select form-control">
                            <?php
                            include 'koneksi.php';
                            $al = mysqli_query($koneksi, "SELECT*FROM album");
                            while($album = mysqli_fetch_array($al)){
                                ?>
                                <option

                                <?php
                                     if($data['albumid'] == $album['albumid']) echo 'selected';
                                ?>

                                value="<?php echo $album['albumid']; ?>"><?php echo $album['namaalbum']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                   
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><input type="date" name="tanggal" value="<?php echo $data['tanggal']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Gambar</td>
                    <td>:</td>
                    <td><input type="file" name="gambar" class="form-control">
                    <a href="gambar/<?php echo $data['gambar']; ?>" target="_blank"> 
                        <img src="gambar/<?php echo $data['gambar'];?>" width ="200"alt="gambar">
                     </a>
                     <br>
                     <i class="text-danger">*Jika tidak di ganti,kosongkan saja</i>
                </td>
                 
                </tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </td>
            </table>

        </form>
</div>
   