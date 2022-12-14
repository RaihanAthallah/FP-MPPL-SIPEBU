<?php
session_start();
include 'dbconnect.php';

if(!isset($_SESSION['log'])){
	header('location:login.php');
} else {
	
};
	
	$uid = $_SESSION['id'];
	$caricart = mysqli_query($conn,"select * from cart where userid='$uid' and status='Cart'");
	$fetc = mysqli_fetch_array($caricart);
    if(!isset($fetc['orderid'])){
        echo " <div class='alert alert-warning' role='alert'>
        Keranjang masih kosong
        </div>
        ";
    }
    else{
        $orderidd = $fetc['orderid'];
        $itungtrans = mysqli_query($conn,"select count(detailid) as jumlahtrans from detailorder where orderid='$orderidd'");
        $itungtrans2 = mysqli_fetch_assoc($itungtrans);
        $itungtrans3 = $itungtrans2['jumlahtrans'];
    }

    global $orderidd;
    global $itungtrans;
    global $itungtrans2;
    global $itungtrans3;
	
	
if(isset($_POST["update"])){
	$kode = $_POST['idproduknya'];
	$jumlah = $_POST['jumlah'];
    $size = $_POST['size'];
	$q1 = mysqli_query($conn, "update detailorder set qty='$jumlah', size = '$size' where idproduk='$kode' and orderid='$orderidd'");
	if($q1){
		echo "<div class='alert alert-success' role='alert'>
        Berhasil Edit Keranjang
        </div>
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
	} else {
		echo "<div class='alert alert-warning' role='alert'>
        Gagal edit keranjang
        </div>
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
	}
} else if(isset($_POST["hapus"])){
	$kode = $_POST['idproduknya'];
	$q2 = mysqli_query($conn, "delete from detailorder where idproduk='$kode' and orderid='$orderidd'");
	if($q2){
		echo "<div class='alert alert-success' role='alert'>
        Berhasil hapus
        </div>
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
	} else {
		echo "<div class='alert alert-warning' role='alert'>
        Gagal hapus
        </div>
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Sipebu - Keranjang Saya</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" /> -->
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

<body style="background-color: #f5eeef;">
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
                    <a class="btn btn-primary m-4" href="Logout.php" role="button">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- //navigation -->

    <!-- checkout -->
    <div class="checkout">
        <div class="container">
            <h2>Dalam keranjangmu ada : <span><?php echo $itungtrans3 ?> barang</span></h2>
            <div class="checkout-right">
                <table class="timetable_sub">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Produk</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Size</th>


                            <th>Harga Satuan</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>

                    <?php 
						$brg=mysqli_query($conn,"SELECT * from detailorder d, produk p where orderid='$orderidd' and d.idproduk=p.idproduk order by d.idproduk ASC");
						$no=1;
						while($b=mysqli_fetch_array($brg)){

					?>
                    <tr class="rem1">
                        <form method="post">
                            <td class="invert"><?php echo $no++ ?></td>
                            <td class="invert"><a href="product.php?idproduk=<?php echo $b['idproduk'] ?>"><img
                                        src="<?php echo $b['gambar'] ?>" width="100px" height="100px" /></a></td>
                            <td class="invert"><?php echo $b['namaproduk'] ?></td>
                            <td class="invert">
                                <div class="quantity">
                                    <div class="quantity-select">
                                        <input type="number" name="jumlah" class="form-control" height="100px"
                                            value="<?php echo $b['qty'] ?>" \>
                                    </div>
                                </div>
                            </td>
                            <td class="invert">
                                <div class="size">
                                    <div class="size-select">
                                        <input type="text" name="size" class="form-control" height="100px"
                                            placeholder="Jika lebih dari 1 tulis (M,L,XL) "
                                            value="<?php echo $b['size'] ?>" \>
                                    </div>
                            </td>

                            <td class="invert">Rp<?php echo number_format($b['harga']) ?></td>
                            <td class="invert">
                                <div class="rem">

                                    <input type="submit" name="update" class="form-control" value="Update" \>
                                    <input type="hidden" name="idproduknya" value="<?php echo $b['idproduk'] ?>" \>
                                    <input type="submit" name="hapus" class="form-control" value="Hapus" \>
                        </form>
            </div>
            <script>
            $(document).ready(function(c) {
                $('.close1').on('click', function(c) {
                    $('.rem1').fadeOut('slow', function(c) {
                        $('.rem1').remove();
                    });
                });
            });
            </script>
            </td>
            </tr>
            <?php
						}
					?>

            <!--quantity-->
            <script>
            $('.value-plus').on('click', function() {
                var divUpd = $(this).parent().find('.value'),
                    newVal = parseInt(divUpd.text(), 10) + 1;
                divUpd.text(newVal);
            });

            $('.value-minus').on('click', function() {
                var divUpd = $(this).parent().find('.value'),
                    newVal = parseInt(divUpd.text(), 10) - 1;
                if (newVal >= 1) divUpd.text(newVal);
            });
            </script>
            <!--quantity-->
            </table>
        </div>
        <div class="checkout-left">
            <div class="checkout-left-basket">
                <h4>Total Harga</h4>
                <ul>
                    <?php 
						$brg=mysqli_query($conn,"SELECT * from detailorder d, produk p where orderid='$orderidd' and d.idproduk=p.idproduk order by d.idproduk ASC");
						$no=1;
						$subtotal = 10000;
						while($b=mysqli_fetch_array($brg)){
						$hrg = $b['harga'];
						$qtyy = $b['qty'];
						$totalharga = $hrg * $qtyy;
						$subtotal += $totalharga
						?>
                    <li><?php echo $b['namaproduk']?><i> - </i> <span>Rp<?php echo number_format($totalharga) ?> </span>
                    </li>
                    <?php
						}
						?>
                    <li>Total (inc. 10k Ongkir)<i> - </i> <span>Rp<?php echo number_format($subtotal) ?></span></li>
                </ul>
            </div>
            <div class="checkout-right-basket">
                <a href="index.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue
                    Shopping</a>
                <a href="checkout.php"><span class="glyphicon glyphicon-menu-right"
                        aria-hidden="true"></span>Checkout</a>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    </div>
    <!-- //checkout -->
    <!-- //footer -->
    <!-- <div class="text-center text-lg-start text-muted">
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
    </div> -->
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