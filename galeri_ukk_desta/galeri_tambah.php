<?php
include "koneksi.php";
if(isset($_POST['judul'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['Deskripsi'];
    $albumid = $_POST['albumid'];
    $tanggal = $_POST['tanggal'];
    $userid = $_SESSION['user']['userid'];
    $gambar = $_FILES['gambar'];
    $nama_gambar = $gambar['name'];
    
    move_uploaded_file($gambar['tmp_name'], 'gambar/'.$gambar['name']);
    $query = mysqli_query($koneksi, "INSERT INTO foto(judul,Deskripsi,albumid,tanggal,gambar,userid) VALUES('$judul','$deskripsi','$albumid','$tanggal','$nama_gambar',$userid)");

    if ($query > 0) {
        echo '<script>alert("Tambah Data Berhasil");</script>';
    
    }else{
        echo '<script>alert("Tambah Data Gagal");</script>';
    }
}
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
                    <td><input type="text" name="judul" class="form-control"></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td><input type="text" name="Deskripsi" class="form-control"></td>
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
                                <option value="<?php echo $album['albumid']; ?>"><?php echo $album['namaalbum']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                   
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><input type="date" name="tanggal" class="form-control"></td>
                </tr>
                <tr>
                    <td>Gambar</td>
                    <td>:</td>
                    <td><input type="file" name="gambar" class="form-control"></td>
                    
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
   