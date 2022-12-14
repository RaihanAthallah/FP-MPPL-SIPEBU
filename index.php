<?php
session_start();
include 'dbconnect.php';
 
		$brgs=mysqli_query($conn,"SELECT * from produk where stok > 0 order by idproduk ASC");
		$no=1;
		while($p=mysqli_fetch_array($brgs)){

												
?>

<!DOCTYPE html>
<html>

<head>
    <title>SIPEBU</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Java Butik Muslim Fashion" />
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
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/jumbotron.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/font-awesome.css" rel="stylesheet">
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
    <div class="container jumbotron">
        <div class="header align-items-center justify-content-center">
            <div class="row">
                <!-- Menu Start-->
                <div class="menu col-6">
                    <div class="text col-12">
                        <div class="top_text">
                            <span>Koleksi Baru </span>
                        </div>
                        <div class="center_text">
                            <span>Java Butik</span>
                        </div>
                        <div class="center_text">
                            <span>Fashion Fest</span>
                        </div>
                        <!-- <div class="bottom_text">
                            <span>Software Dev</span>
                        </div> -->

                        <!--My Info-->
                        <div class="my_info">
                            <button class="btn">Belanja Sekarang</button>
                        </div>
                        <!--my info end-->
                    </div>
                </div>
                <!--end menu-->

                <div class="photo_frame col-5">
                    <div class="photo">
                        <img src="images\javabutik.png" />
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!-- Jumbotron -->
    <!-- //top-header and slider -->
    <!-- top-brands -->
    <div class="container my-5 py-5">
        <h1 align="center">KOLEKSI TOKO</h1>
        <hr>
        <br>
        <br>
        <div class="row">
            <?php $i = 1; ?>
            <?php foreach($brgs as $p) : ?>
            <div class="col-md-3 top_brand_left my-2 rounded">
                <div class="hover14 column rounded">
                    <div class="agile_top_brand_left_grid rounded">
                        <div class="agile_top_brand_left_grid1 rounded">
                            <figure>
                                <div class="snipcart-item block">
                                    <div class="snipcart-thumb">
                                        <a href="product.php?idproduk=<?php echo $p['idproduk'] ?>"><img
                                                src="<?php echo $p['gambar']?>" width="200px" height="200px"></a>
                                        <p><?php echo $p['namaproduk'] ?></p>
                                        <h4>Rp<?php echo number_format($p['harga']) ?>

                                        </h4>
                                    </div>
                                    <div class="snipcart-details top_brand_home_details">
                                        <fieldset>
                                            <a href="product.php?idproduk=<?php echo $p['idproduk'] ?>"><input
                                                    type="submit" class="btn btn-outline-secondary"
                                                    value="Lihat Produk" /></a>
                                        </fieldset>
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++; ?>
            <?php endforeach ?>
        </div>
        <?php
		}
	    ?>
    </div>
    </div>


    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- //top-brands-->




    <footer class="text-center text-lg-start text-muted bg-pink py-4">
        <!-- //footer -->
        <section class="mt-4">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <img src="images/logo.png" alt="">
                        <h6 class="text-uppercase fw-bold mb-4"><i class="fas fa-gem me-3"></i>Java Butik Indonesia</h6>
                        <p>Terbaik,Tercantik,Terindah</p>
                        <p>Sahabat fashionis seluruh Indonesia</p>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                        <h6 class="text-uppercase fw-bold mb-4">
                            Social Media
                        </h6>
                        <p>
                            <a href="https://www.facebook.com/javamoslemfashion.official/"
                                class="text-reset">Facebook</a>
                        </p>
                        <p>
                            <a href="https://www.instagram.com/javamoslemfashion/?hl=en"
                                class="text-reset">Instagram</a>
                        </p>
                        <p>
                            <a href="https://www.youtube.com/channel/UC5WGxt5ZxORe8c7w9jUttTw"
                                class="text-reset">Youtube</a>
                        </p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3"></i> SOGO Pakuwon Mall Surabaya</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            javamoslemfashion@gmail.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> +62 813-3621-5118</p>
                        <p><i class="fas fa-print me-3"></i> +62 813-3511-0650</p>
                    </div>
                </div>
            </div>
        </section>
    </footer>
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