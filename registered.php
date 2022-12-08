<?php
session_start();
if(!isset($_SESSION['log'])){
	
} else {
	header('location:index.php');
};
include 'dbconnect.php';

if(isset($_POST['adduser']))
	{
        $email = htmlspecialchars($_POST['email']);
        $cekEmail = mysqli_query($conn,"SELECT email FROM login WHERE email = '$email'" );
        $result = mysqli_fetch_assoc($cekEmail);
        if($result == NULL){
            $nama = htmlspecialchars($_POST['nama']);
            $telp = htmlspecialchars($_POST['telp']);
            $alamat = htmlspecialchars($_POST['alamat']);
            $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $query = "insert into login (namalengkap, email, password, notelp, alamat) 
            values('$nama','$email','$pass','$telp','$alamat')";
    
                //global $query;
                $tambahuser = mysqli_query($conn,$query);

                if ($tambahuser){
                        echo " <div class='alert alert-success'>
                        Berhasil mendaftar, silakan masuk.
                        </div>
                        <meta http-equiv='refresh' content='1; url= login.php'/>  ";
                } 
                else { 
                        echo "<div class='alert alert-warning'>
                        Gagal mendaftar, silakan coba lagi.
                        </div>
                        <meta http-equiv='refresh' content='1; url= registered.php'/> ";
                }
    
        }
        else{
            echo "<div class='alert alert-warning'>
            Email Sudah digunakan
            </div>
            <meta http-equiv='refresh' content='1; url= registered.php'/> ";
            // die;
        }
            // $nama = htmlspecialchars($_POST['nama']);
            // $telp = htmlspecialchars($_POST['telp']);
            // $alamat = htmlspecialchars($_POST['alamat']);
            // //$email = htmlspecialchars($_POST['email']);
            // $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            // //$cekEmail = mysqli_query($conn,"SELECT email FROM login WHERE email = '$email'" );
            // $query = "insert into login (namalengkap, email, password, notelp, alamat) 
            // values('$nama','$email','$pass','$telp','$alamat')";
            // //$result = mysqli_fetch_assoc($cekEmail);
            // // var_dump($result);
            // // die;
            // // if($result == NULL){
            // //     // if ($result['email'] == $email){
            // //         echo "<div class='alert alert-warning'>
            // //                             Email Sudah digunakan
            // //                         </div>
            // //         <meta http-equiv='refresh' content='1; url= registered.php'/> ";
            // //         // die;
            // //     // }
            // // }
            
            // else{
            //     global $query;
            //     $tambahuser = mysqli_query($conn,$query);

            //     if ($tambahuser){
            //             echo " <div class='alert alert-success'>
            //             Berhasil mendaftar, silakan masuk.
            //             </div>
            //             <meta http-equiv='refresh' content='1; url= login.php'/>  ";
            //     } 
            //     else { 
            //             echo "<div class='alert alert-warning'>
            //             Gagal mendaftar, silakan coba lagi.
            //             </div>
            //             <meta http-equiv='refresh' content='1; url= registered.php'/> ";
            //     }
            // }
            
		
		
	};

?>

<!DOCTYPE html>
<html>

<head>
    <title>Sipebu - Daftar</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Java Butik Muslim Fashion" />
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
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- //js -->
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">

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

        </div>
    </nav>
    <!-- //navigation -->

    <!-- register -->
    <div class="register">
        <div class="container">
            <h2>Daftar Disini</h2>
            <div class="login-form-grids">
                <h5>Informasi Pribadi</h5>
                <form method="post">
                    <input type="text" name="nama" placeholder="Nama Lengkap" required>
                    <input type="text" name="telp" placeholder="Nomor Telepon" required maxlength="13">
                    <input type="text" name="alamat" placeholder="Alamat Lengkap" required>

                    <h6>Informasi Login</h6>

                    <input type="email" name="email" placeholder="Email" required="@">
                    <input type="password" name="pass" placeholder="Password" required>
                    <input type="submit" name="adduser" value="Daftar">
                </form>
            </div>
            <div class="register-home">
                <a href="index.php">Batal</a>
            </div>
        </div>
    </div>
    <!-- //register -->
    <!-- //footer -->
    <footer class="text-center text-lg-start bg-light text-muted">
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

        <!-- //footer -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4"><i class="fas fa-gem me-3"></i>Company name</h6>
                        <p>
                            Here you can use rows and columns to organize your footer content. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.
                        </p>
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

        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
        <!-- //footer -->
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- top-header and slider -->
        <!-- here stars scrolling icon -->
        <script type="text/javascript">
        $(document).ready(function() {

            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 4000,
                easingType: 'linear'
            };


            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
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