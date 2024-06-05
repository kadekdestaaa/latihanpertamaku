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
        <a href="galeri_tambah.php" class="btn btn-primary">+ Tambah Galeri</a>
    <table class="table table-bordered">
        <tr>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Album</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Total Like</th>
            <th>Aksi</th>
        </tr>
        <?php
        include "koneksi.php";

        $query = mysqli_query($koneksi, "SELECT foto.*,album.namaalbum FROM foto left join album on album.albumid = foto.albumid");
        while($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td>
                   <a href="gambar/<?php echo $data['gambar']; ?>" target="_blank"> 
                  <img src="gambar/<?php echo $data['gambar'];?>" width ="200"alt="gambar">
                  </a>
               </td>
                <td><?php echo $data['judul'];?></td>
                <td><?php echo $data['namaalbum'];?></td>
                <td><?php echo $data['Deskripsi'];?></td>
                <td><?php echo $data['tanggal'];?></td>
                <td><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM likefoto WHERE fotoid=" . $data['fotoid']));?></td>
                <td>
                    <?php
                    if(mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM likefoto WHERE fotoid=" . $data['fotoid'] . " AND userid=" . $_SESSION['user']['userid'] ))< 1){
                     ?>   
                    <a href="galeri_like.php?id=<?php echo $data['fotoid'];?>" class="btn btn-warning">Like</a>
                    <?php
                    }
                    ?>

                    <a href="galeri_komentar.php?id=<?php echo $data['fotoid'];?>" class="btn btn-warning">Komentar</a>
                    <a href="galeri_ubah.php?id=<?php echo $data['fotoid'];?>" class="btn btn-primary">Ubah</a>
                    <a href="galeri_hapus.php?id=<?php echo $data['fotoid'];?>" class="btn btn-danger">Hapus</a>
                </td>   
            </tr>
            <?php
        }

        ?>
        
    </table>
                        
</div>
</body>
</html>