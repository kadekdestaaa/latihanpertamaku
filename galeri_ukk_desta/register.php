<?php
include "koneksi.php";

if (isset($_POST['username'])) {
    $nama = $_POST['namalengkap'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // **Improvement 1: Use prepared statements to prevent SQL injection**
    $stmt = mysqli_prepare($koneksi, "INSERT INTO user (namalengkap, email, alamat, username, password) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "sssss", $nama, $email, $alamat, $username, $password);
    $cek = mysqli_stmt_execute($stmt);

    if ($cek) {
        echo '<script>alert("Register Berhasil, Silakahkan Login")</script>';
        header("Location: login.php");
    } else {
        // **Improvement 2: Use mysqli_error to get the error message**
        echo '<script>alert("Register gagal: '. mysqli_error($koneksi). '")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register Galeri Foto</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="post">

                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="text" placeholder="Masukkan Nama Lengkap" name="namalengkap" />
                                                <label for="inputemail">namalengkap</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="text" placeholder="Masukkan Email" name="email" />
                                                <label for="inputEmail">Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="text" placeholder="Masukkan alamat" name="alamat" />
                                                <label for="inputemail">Alamat</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="text" placeholder="Masukkan Username" name="username" />
                                                <label for="inputEmail">username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Masukkan Password" name="password"  />
                                                <label for="inputPassword">password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit">Register</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Sudah Punya Akun? Login!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
