<?php
include "koneksi.php";
$id = $_GET['id'];
$userid = $_SESSION['user']['userid'];
$tanggal = date("Y/m/d");

$query = mysqli_query($koneksi, "INSERT INTO likefoto(fotoid,userid,tanggallike) values ('$id','$userid','$tanggal')");

if ($query > 0) {
    echo '<script>alert("Like Data Berhasil"); location.href="galeri.php"</script>';

}else{
    echo '<script>alert("Like Data Gagal");</script>';
}
?>
