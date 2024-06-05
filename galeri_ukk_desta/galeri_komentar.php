<?php
include "koneksi.php";
$id = $_GET['id'];



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
                    <td><?php echo $data['judul']; ?></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td><?php echo $data['Deskripsi']; ?></td>
                </tr>
                <tr>
                    <td>Album</td>
                    <td>:</td>
                    <td>
                        <select name="albumid" disabled class="form-select form-control">
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
                    <td> <?php echo $data['tanggal']; ?></td>
                </tr>
                <tr>
                    <td>Gambar</td>
                    <td>:</td>
                    <td>
                    <a href="gambar/<?php echo $data['gambar']; ?>" target="_blank"> 
                        <img src="gambar/<?php echo $data['gambar'];?>" width ="200"alt="gambar">
                     </a>
                     <br>
                     
                </td>
                 
                </tr>
            </table>

        </form>

        <h1 class="mt-4">Komentar Foto</h1>
        <?php
        
        $query = mysqli_query($koneksi, "SELECT*FROM komentarfoto left join user on user.userid = komentarfoto.userid where komentarfoto.fotoid=$id");
        while($data = mysqli_fetch_array($query)) {
            ?>
            <div class="card mb-2 ">
                <div class="card-header bg-primary"><?php echo $data['namalengkap'] . '('.$data ['tanggalkomentar'].')'; ?></div>
                <div class="card-body"><?php echo $data['isikomentar']; ?></div>

            </div>
           <?php
        }
    
    if(isset($_POST['komentarfoto'])) {
    $komentar= $_POST['komentarfoto'];
    $tanggal = date("Y/m/d");
    $userid = $_SESSION['user']['userid'];
    
    $query = mysqli_query($koneksi, "INSERT INTO komentarfoto(fotoid,userid,isikomentar,tanggalkomentar) values('$id','$userid','$komentar','$tanggal')");
    
    if ($query > 0) {
        echo '<script>alert("Tambah Komentar Berhasil");</script>';
    
    }else{
        echo '<script>alert("Tambah Komentar Gagal");</script>';
    }
}
         ?>
         
         <form method="post">
         <hr>
         <label>Masukan Komentar Baru</label>
         <textarea name="komentarfoto" rows="5" class="form-control"></textarea>
         <button type="submit" class=btn-btn-primary>Simpan</button>
         </form>
         
</div>
     