<?php
session_start();
   if(empty($_SESSION['username']))
{
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
        <?php if($_SESSION): ?>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Pasien</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../dokter/dokter.php">Dokter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../kamar/kamar.php">Kamar</a>
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
        <div class="row" style="margin-top: 100px;;">
        <div class="col"></div>
            <div class="col col-lg-11" style=" padding: 30px">
                <h1>Data Pasien Klinik</h1>
                <table class="table table-bordered" style="margin-top: 70px;;">
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Usia</th>
                        <th>Tipe</th>
                        <th>Kontak</th>
                        <th>Kamar</th>
                        <th>Dokter</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    include('../koneksi.php');

                    $sql	= "";
                    $sql	= "SELECT p.*, k.*, d.* FROM dokter d INNER JOIN kamar k INNER JOIN pasien p ON p.id_dokter=d.id_dokter AND p.id_kamar=k.id_kamar  ORDER BY p.nama ASC";

                    $query	= mysqli_query($connect, $sql);
                    $no =1;

                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['kelamin']; ?></td>
                        <td><?= $data['umur']; ?></td>
                        <td>Rawat <?= $data['tipe']; ?></td>
                        <td><?= $data['kontak']; ?></td>
                        <td><?= $data['kamar']; ?> - <?= $data['fasilitas']; ?></td>
                        <td>Dr. <?= $data['namadok']; ?></td>
                        <td><?= $data['tanggal']; ?></td>
                        <td> <a href="" type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#myModal<?php echo $data['id_pasien']; ?>"><i class="bi bi-info-circle"></i></a>
                    </tr>
                    <div class="modal fade" id="myModal<?php echo $data['id_pasien']; ?>" role="dialog" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content" style="padding: 10px;">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Data Pasien</h1>
                                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                                </div>
                                
                                <form role="form" action="editpasien.php?id_pasien=<?php echo $data['id_pasien'];?>" method="POST">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="bambang.." value="<?=$data['nama']?>" name="nama" required="">
                                        <label for="floatingInput">Nama</label>
                                    </div>
                                    <div class="form-floating" style="margin: 17px 0px">
                                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example"  name="kelamin">
                                            <option value="<?=$data['kelamin']?>"><?=$data['kelamin']?></option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        <label for="floatingSelect">Jenis Kelamin</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="Mata, THT, etc.." value="<?=$data['umur']?>" name="umur" required="">
                                        <label for="floatingInput">Umur</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="30" value="<?=$data['kontak']?>" name="kontak" required="">
                                        <label for="floatingInput">Kontak</label>
                                    </div>
                                    <div class="form-floating" style="margin: 17px 0px">
                                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example"  name="tipe">
                                            <option value="<?=$data['tipe']?>">Rawat <?=$data['tipe']?></option>
                                            <option value="Inab">Rawat Inab</option>
                                            <option value="Jalan">Rawat Jalan</option>
                                        </select>
                                        <label for="floatingSelect">Tipe</label>
                                    </div>
                                    <div class="form-floating" style="margin: 17px 0px">
                                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="id_kamar">
                                            <option value="<?=$data['id_kamar']?>"><?=$data['kamar']?></option>
                                            <option value="6">tidak menginab</option>
                                            <?php
                                            $sql	= "SELECT * FROM kamar WHERE id_kamar != ALL(SELECT id_kamar from pasien) ORDER BY kamar ASC;";
                                            $query1	= mysqli_query($connect, $sql); 
                                            while ($row = mysqli_fetch_array($query1)) {
                                            ?>
                                            <option value="<?= $row['id_kamar']; ?>"><?= $row['kamar']; ?> (<?= $row['fasilitas']; ?>)</option>
                                            <?php } ?>
                                        </select>
                                        <label for="floatingSelect">Kamar</label>
                                    </div>
                                    <div class="form-floating" style="margin: 17px 0px">
                                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="id_dokter">
                                            <option value="<?=$data['id_dokter']?>"><?=$data['namadok']?></option>
                                            <?php
                                            $sql	= "SELECT * FROM dokter ORDER BY namadok ASC";
                                            $query2	= mysqli_query($connect, $sql);
                                            while ($row = mysqli_fetch_array($query2)) {
                                            ?>
                                            <option value="<?= $row['id_dokter']; ?>">Dr. <?= $row['namadok']; ?> (<?= $row['spesialis']; ?>)</option>
                                            <?php } ?>
                                        </select>
                                        <label for="floatingSelect">Dokter</label>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="delete_pasien.php?id_pasien=<?php echo $data['id_pasien'];?>"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
                                        <button type="submit" class="btn btn-primary" value="Upload">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>          
                    </div>
                    <?php } ?>
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row" style="margin-top: 150px;;">
        <div class="col"></div>
            <div class="col col-lg-6" style=" padding: 30px">
            <hr>
                <h1>Input Data</h1>
                <p>Masukan biodata Pasien</p><br>
                <form action="pasien_proses.php" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="bambang.." name="nama" required="">
                        <label for="floatingInput">Nama</label>
                    </div>
                    <div class="form-floating" style="margin: 17px 0px">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="kelamin" required>
                            <option value="">Open this select menu</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <label for="floatingSelect">Jenis Kelamin</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="Mata, THT, etc.." name="umur" required="">
                        <label for="floatingInput">Umur</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="30" name="kontak" required="">
                        <label for="floatingInput">Kontak</label>
                    </div>
                    <div class="form-floating" style="margin: 17px 0px">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="tipe" required>
                            <option value="">Open this select menu</option>
                            <option value="Inab">Rawat Inab</option>
                            <option value="Jalan">Rawat Jalan</option>
                        </select>
                        <label for="floatingSelect">Tipe</label>
                    </div>
                    <div class="form-floating" style="margin: 17px 0px">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="kamar">
                            <option value="6">Pilih Kamar</option>
                            <?php
                            include('koneksi.php');

                            $sql	= "SELECT * FROM kamar WHERE id_kamar != ALL(SELECT id_kamar from pasien) AND id_kamar != 6 ORDER BY kamar ASC;";
                            $query	= mysqli_query($connect, $sql);
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <option value="<?= $data['id_kamar']; ?>"><?= $data['kamar']; ?> (<?= $data['fasilitas']; ?>)</option>
                            <?php } ?>
                        </select>
                        <label for="floatingSelect">Kamar (wajib diisi ketika menginab)</label>
                    </div>
                    <div class="form-floating" style="margin: 17px 0px">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="id_dokter" required>
                            <option value="-">Pilih Dokter</option>
                            <?php
                            include('koneksi.php');

                            $sql	= "SELECT * FROM dokter ORDER BY namadok ASC";
                            $query	= mysqli_query($connect, $sql);
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <option value="<?= $data['id_dokter']; ?>">Dr. <?= $data['namadok']; ?> (<?= $data['spesialis']; ?>)</option>
                            <?php } ?>
                        </select>
                        <label for="floatingSelect">Dokter</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="floatingInput" placeholder="30" name="tanggal" required="">
                        <label for="floatingInput">Tanggal Masuk</label>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto" style="margin-top: 70px">
                        <button class="btn btn-primary" type="submit" value="Upload">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
