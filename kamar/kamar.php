<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <img src="../assets/barber.jpg" alt="Barber" style="width: 80px; height: auto;">
            <span class="fs-4">BarBerBuy</span>
        </a>
        <?php if ($_SESSION): ?>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pasien/pasien.php">Pasien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../dokter/dokter.php">Dokter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Kamar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">Logout</a>
                </li>
            </ul>
        <?php else: ?>
            <div class="col-md-3 text-end">
                <a href="login.php"><span class="nav-link">Login</span></a>
                <a href="signup.php"><span class="nav-link">Sign-up</span></a>
            </div>
        <?php endif; ?>
    </header>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk keluar?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="../logout.php"><button type="button" class="btn btn-primary">Logout</button></a>

                </div>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="row" style="margin-top: 100px;">
            <div class="col" style="padding: 30px">
                <h1>Daftar Kamar Klinik ABUY</h1><br><br>
                <table class="table table-bordered">
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Kamar</th>
                        <th>fasilitas</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    include('../koneksi.php');

                    $sql    = "SELECT kamar.id_kamar, kamar.kamar, kamar.fasilitas,
                    CASE
                        WHEN kamar.id_kamar = pasien.id_kamar THEN 'Used'
                        ELSE 'Unused'
                    END AS statustext
                    FROM kamar LEFT JOIN pasien ON kamar.id_kamar=pasien.id_kamar WHERE kamar.id_kamar != 6;";
                    $query    = mysqli_query($connect, $sql);
                    $no = 1;

                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['kamar']; ?></td>
                            <td><?= $data['fasilitas']; ?></td>
                            <td><?php if ($data['statustext'] == 'Used') echo '<span class="badge text-bg-success">Used</span>';
                                else echo '<span class="badge text-bg-warning">Unused</span>';
                                ?>
                            <td> <a href="delete_kamar.php?id_kamar=<?php echo $data['id_kamar']; ?>"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></button></a></td>
                        </tr>
                    <?php } ?>
                </table>
                <?php

                if (isset($_GET['message'])) {
                    if ($_GET['message'] == "gagal") { ?>
                        <div class="alert alert-danger" role="alert">Data kamar tidak dapat dihapus</div>
                <?php          }
                }
                ?>
            </div>
            <div class="col" style="padding: 30px">
                <h1>Input Data Kamar</h1>
                <hr>
                <p>Masukkan Kamar yang Tersedia</p>
                <form action="kamar_proses.php" method="POST">
                    <div class="form-floating mb-3" style="margin-top:100px">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Mata, THT, etc.." name="kamar" required="">
                        <label for="floatingInput">No Kamar</label>
                    </div>
                    <div class="form-floating" style="margin: 17px 0px">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="fasilitas" required>
                            <option value="">Open this select menu</option>
                            <option value="Kelas 1">Kelas 1</option>
                            <option value="Kelas 2">Kelas 2</option>
                            <option value="Kelas 3">Kelas 3</option>
                        </select>
                        <label for="floatingSelect">Fasilitas</label>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>