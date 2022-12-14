<?php 
    session_start();
	if(!isset($_SESSION['log'])){
	header('location:login.php');
    } 
    else {
        // var_dump($_SESSION['id']);
        // die;
    };
	include './dbconnect.php';

	// $userid =$_SESSION['id']];
    if(isset($_SESSION['id'])){
        $userid = $_SESSION['id'];
        $brgs=mysqli_query($conn,"SELECT * from login  where userid = $userid");
        $result = mysqli_fetch_assoc($brgs);
        // var_dump($result);
        // die;
    }
    else{
        echo "<script>alert('Data Gagal diedit!');
        document.location.href = 'pembayaran.php;</script>";
    }
   global $result;
    function upload(){
        global $conn;
        $namaFile = $_FILES['uploadgambar']['name'];
        $ukuranFile = $_FILES['uploadgambar']['size'];
        $error = $_FILES['uploadgambar']['error'];
        $tmpName = $_FILES['uploadgambar']['tmp_name'];
        
        if($error === 4) {
            echo "<script>
                alert('Please choose an image!');
                document.location.href = 'index.php';
            </script>";
            return false;
        }
        // cek yg diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        // gunakan expload untuk memecah string setelah "."
        $ekstensiGambar = explode('.', $namaFile);
        // strtolower untuk mengubah huruf menjadi huruf kecil
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        // cek dalam array apakah terdapat ekstensi gambar yang valid
        if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                alert('Please choose a valid image!');
                document.location.href = 'index.php';
            </script>";
            return false;
        }
        // cek ukuran file apabila lebih kembalikan error
        if($ukuranFile > 1000000) {
            echo "<script>
                alert('Please choose a smaller image!');
                document.location.href = 'index.php';
            </script>";
            return false;
        }
        // generate nama file baru
        $namafilebaru = uniqid();
        $namafilebaru .= '.';
        $namafilebaru .= $ekstensiGambar;
        // copy file ke folder img
        move_uploaded_file($tmpName, './pelanggan/' . $namafilebaru);
        return $namafilebaru;
    }

    function update($data,$idproduk){
        global $conn;
        global $userid;
		$username = $data['uname'];
		$password = password_hash($data['upass'], PASSWORD_DEFAULT); 
        $namalengkap = $data['nama'];
        $email = $data['email'];
		$notelp = $data['telepon'];
        $alamat = $data['alamat'];
		
		$imagelama = htmlspecialchars($data["imageLama"]);

        if($_FILES['uploadgambar']['error'] === 4) {
            $image = $imagelama;
            $query = "UPDATE login SET namalengkap = '$namalengkap', email = '$email', notelp = '$notelp', password = '$password', alamat = '$alamat', foto = '$image' WHERE userid = $userid";
            mysqli_query($conn, $query);
        } else {
            $image = upload();
            $query = "UPDATE login SET namalengkap = '$namalengkap', email = '$email', notelp = '$notelp', password = '$password', alamat = '$alamat', foto = '/pelanggan/$image' WHERE userid = $userid";
            mysqli_query($conn, $query);
        }
        return mysqli_affected_rows($conn);
    }
	if(isset($_POST["submit"])) {
        // var_dump($_POST);
        // die;
        if(update($_POST,$idproduk) > 0){
            echo "<script> alert('Data Berhasil diedit!');
            document.location.href = 'index.php';</script>";
        } 
        else {
            //var_dump($data_produk); die;
            echo "<script>alert('Data Gagal diedit!');
            document.location.href = 'akun.php';</script>";
}
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sipebu</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Java butik muslim fashion" />
    <link rel="shortcut icon" type="image/png" href=".\images\logo.png">
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- //for-mobile-apps -->
    <!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- //js -->
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">

    <!-- <link
        href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'> -->
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event) {
            event.preventDefault();
            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 1000);
        });
    });
    </script>
    <!-- start-smoth-scrolling -->
</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?">
                <img src=".\images\logo.png" alt="" width="50" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rekomendasi.php">Rekomendasi</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>
                        <ul class="dropdown-menu px-4" aria-labelledby="navbarScrollingDropdown">

                            <?php 
								$kat=mysqli_query($conn,"SELECT * from kategori order by idkategori ASC");
								while($p=mysqli_fetch_array($kat)){

							?>
                            <li class="mb-2">
                                <a href="kategori.php?idkategori=<?php echo $p['idkategori'] ?>">
                                    <?php echo $p['namakategori'] ?></a>
                            </li>

                            <?php
								}
							?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftarorder.php">Order</a>
                    </li>
                </ul>
                <div class="w3l_search">
                    <form action="search.php" method="post">
                        <input type="search" name="Search" placeholder="Cari produk...">
                        <button type="submit" class="btn btn-default search" aria-label="Left Align">
                            <i aria-hidden="true"><img src="images/search.png" alt="" width="15px">
                            </i>
                        </button>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <div class="mx-4">
                    <a class="navbar-brand" href="akun.php">
                        <img src=".\images\user.png" alt="" width="20" height="20">
                    </a>
                    <a class="navbar-brand" href="cart.php">
                        <img src=".\images\cart.png" alt="" width="33" height="20">
                    </a>
                    <a class="btn btn-primary m-4" href="logout.php" role="button">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- navigation -->
    <!-- Jumbotron -->
    <!-- <div class="container jumbotron">
        <div class="d-flex align-items-center justify-content-center java_butik">
            <h1 class="mx-4 headline"> Java Butik Fashion</h1>
            <img class="" src="images/javabutik.png" alt="">
        </div>
    </div> -->
    <!-- Jumbotron -->
    <!-- //top-header and slider -->
    <!-- top-brands -->
    <div class="my-4">
        <form class="mx-auto mt-5 d-flex" style="width: 70%;" action="" method="post" enctype="multipart/form-data">
            <div style="width: 70%;">
                <input type="hidden" name="imageLama" value="<?= $result["foto"] ?>">
                <!-- <div class="form-group">
                            <label>Username</label>
                            <input name="uname" type="text" class="form-control" placeholder="Username" required
                                autofocus>
                        </div> -->
                <div class="form-group">
                    <label>Password</label>
                    <input name="upass" type="password" class="form-control" placeholder="Password"
                        value="<?= $result["password"] ?>">
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input name="nama" type="text" class="form-control" placeholder="Nama Lengkap"
                        value="<?= $result["namalengkap"] ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" placeholder="Email"
                        value="<?= $result["email"] ?>">
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input name="telepon" type="serial" class="form-control" placeholder="Telepon"
                        value="<?= $result["notelp"] ?>">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input name="alamat" type="text" class="form-control" placeholder="Alamat"
                        value="<?= $result["alamat"] ?>">
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input name="uploadgambar" type="file" class="form-control" value="<?= $result["foto"] ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary mt-3">Add</button>
            </div>
            <div class="image mx-4 mt-4"><img src="./<?=$result["foto"]?>" alt="" width="300"></div>

            <!-- <button type="submit" name="submit" class="btn btn-primary mt-3">Add</button> -->
        </form>
    </div>
    </div>


    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- //top-brands-->




    <!-- <footer class="text-center text-lg-start text-muted bg-pink">
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </section>

        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <img src="images/logo.png" alt="">
                        <h6 class="text-uppercase fw-bold mb-4"><i class="fas fa-gem me-3"></i>Java Butik Indonesia</h6>
                        <p>Terbaik,Tercantik,Terindah</p>
                        <p>Sahabat fashionis seluruh Indonesia</p>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p><a href="#!" class="text-reset">Angular</a></p>
                        <p><a href="#!" class="text-reset">React</a></p>
                        <p><a href="#!" class="text-reset">Vue</a></p>
                        <p><a href="#!" class="text-reset">Laravel</a></p>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Help</a>
                        </p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            info@example.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                    </div>
                </div>
            </div>
        </section>
    </footer> -->
    <!-- //footer -->
    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.min.js"></script> -->

    <!-- top-header and slider -->
    <!-- here stars scrolling icon -->
    <script type="text/javascript">
    </script>
    <!-- //here ends scrolling icon -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- main slider-banner -->
    <script src="js/skdslider.min.js"></script>
    <link href="css/skdslider.css" rel="stylesheet">
    <script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#demo1').skdslider({
            'delay': 5000,
            'animationSpeed': 2000,
            'showNextPrev': true,
            'showPlayButton': true,
            'autoSlide': true,
            'animationType': 'fading'
        });

        jQuery('#responsive').change(function() {
            $('#responsive_wrapper').width(jQuery(this).val());
        });

    });
    </script>
    <!-- //main slider-banner -->
</body>

</html>