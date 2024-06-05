<?php
include "koneksi.php";
$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM foto where fotoid=$id");

if ($query > 0) {
    echo '<script>alert("Hapus Data Berhasil"); location.href="galeri.php"</script>';

}else{
    echo '<script>alert("Hapus Data Gagal");</script>';
}
?>
