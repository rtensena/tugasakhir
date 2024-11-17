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
                <a class="nav-link" href="../pasien/pasien.php">Pasien</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Dokter</a>
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
    <div class="container text-center" style="margin-top: 100px;">
        <h1>Dokter Klinik ABUY</h1><br><br>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                include('../koneksi.php');
                $sql	= "SELECT * FROM dokter ORDER BY namadok ASC";
                $query	= mysqli_query($connect, $sql);
                while ($data = mysqli_fetch_array($query)) {
                ?>
                <div class="col">
                    <div class="card h-100 shadow p-2 mb-5 bg-body rounded" >
                        <div style="height: 170px;overflow: hidden;position: relative;" class="rounded">
                            <img src="foto/<?= $data['foto']; ?>" class="card-img-top" alt="orang" style="position: absolute;left: -1000%;right: -1000%;top: -1000%;bottom: -1000%;margin: auto;min-height: 100%;min-width: 100%;">
                            <div class="position-absolute top-0 end-0">
                                <a href="" type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?php echo $data['id_dokter']; ?>"><i class="bi bi-pencil-square"></i></a>
                                    <div class="modal fade" id="myModal<?php echo $data['id_dokter']; ?>" role="dialog" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Data Dokter</h1>
                                                    <!-- <button type="button" class="btn-close" data-dismiss="modal">&times;</button> -->

                                                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                                                </div>
                                                
                                                <form role="form" action="editdokter.php?id_dokter=<?php echo $data['id_dokter'];?>" method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="floatingInput" value="<?php echo $data['namadok']; ?>" name="nama" required="">
                                                            <label for="floatingInput">Nama</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="floatingInput" value="<?php echo $data['spesialis']; ?>" name="spesialis" required="">
                                                            <label for="floatingInput">Spesialis</label>
                                                        </div>
                                                        <div class="form-floating" style="margin: 17px 0px">
                                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" value="<?php echo $data['gender']; ?>" required>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            </select>
                                                            <label for="floatingSelect">Jenis Kelamin</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="number" class="form-control" id="floatingInput" value="<?php echo $data['usia']; ?>" name="usia" required="">
                                                            <label for="floatingInput">Usia</label>
                                                        </div>
                                                        <div class="form-floating">
                                                            <textarea style="resize:none;height:150px;" class="form-control" value="<?php echo $data['alamat']; ?>" id="floatingTextarea"  name="alamat" required="" cols="40" rows="6"><?php echo $data['alamat']; ?></textarea>
                                                            <label for="floatingTextarea">Alamat lengkap</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="delete_dokter.php?id_dokter=<?php echo $data['id_dokter'];?>"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
                                                        <button type="submit" class="btn btn-primary" value="Upload">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>          
                                    </div>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Dr. <?= $data['namadok']; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Dokter <?= $data['spesialis']; ?></h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?= $data['gender']; ?></li>
                                <li class="list-group-item">Usia <?= $data['usia']; ?> tahun</li>
                                <li class="list-group-item"><?= $data['alamat']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php 
                        
                if (isset($_GET['message'])) {
                    if ($_GET['message'] == "gagal") {?>
                        <div class="alert alert-danger" role="alert">Data dokter tidak dapat dihapus</div>
                    <?php          }                
                }
            ?>
    </div>
    <div class="container text-center">
        <div class="row" style="margin-top: 150px;;">
        <div class="col"></div>
            <div class="col col-lg-6" style=" padding: 30px">
            <hr>
                <h1>Input Data</h1>
                <p>Masukan biodata dokter</p><br>
                <form action="dokter_proses.php" method="POST"  enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="bambang.." name="nama" required="">
                        <label for="floatingInput">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Mata, THT, etc.." name="spesialis" required="">
                        <label for="floatingInput">Spesialis</label>
                    </div>
                    <div class="form-floating" style="margin: 17px 0px">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="gender" required>
                            <option value="">Open this select menu</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <label for="floatingSelect">Jenis Kelamin</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="30" name="usia" required="">
                        <label for="floatingInput">Usia</label>
                    </div>
                    <div class="form-floating">
                        <textarea style="resize:none;height:150px;" class="form-control" placeholder="Alamat lengkap" id="floatingTextarea"  name="alamat" required=""></textarea>
                        <label for="floatingTextarea">Alamat</label>
                    </div>
                    <div class="form-floating" style="margin: 17px 0px">
                        <input style="padding: 35px;" type="file" class="form-control" id="floatingInput" placeholder="file" name="foto" required="required">
                        <label for="floatingInput">Foto</label>
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
