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
	// $orderidd = $fetc['orderid'];
	$itungtrans = mysqli_query($conn,"select count(orderid) as jumlahtrans from cart where userid='$uid' and status!='Cart'");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];
	
if(isset($_POST["update"])){
	$kode = $_POST['idproduknya'];
	$jumlah = $_POST['jumlah'];
	$q1 = mysqli_query($conn, "update detailorder set qty='$jumlah' where idproduk='$kode' and orderid='$orderidd'");
	if($q1){
		echo "Berhasil Update Cart
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
	} else {
		echo "Gagal update cart
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
	}
} else if(isset($_POST["hapus"])){
	$kode = $_POST['idproduknya'];
	$q2 = mysqli_query($conn, "delete from detailorder where idproduk='$kode' and orderid='$orderidd'");
	if($q2){
		echo "Berhasil Hapus";
	} else {
		echo "Gagal Hapus";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Sipebu - Daftar Belanja</title>
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
            <h2>Kamu memiliki <span><?php echo $itungtrans3 ?> transaksi</span></h2>
            <div class="checkout-right">
                <table class="timetable_sub">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Order</th>
                            <th>Tanggal Order</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>No Resi</th>
                        </tr>
                    </thead>

                    <?php 
					
						$brg=mysqli_query($conn,"SELECT DISTINCT(idcart), c.orderid, tglorder, status, no_resi from cart c, detailorder d where c.userid='$uid' and d.orderid=c.orderid and status!='Cart' order by tglorder DESC");
						$no=1;
						while($b=mysqli_fetch_array($brg)){

					?>
                    <tr class="rem1">

                        <td class="invert"><?php echo $no++ ?></td>
                        <td class="invert"><a
                                href="order.php?id=<?php echo $b['orderid'] ?>"><?php echo $b['orderid'] ?></a></td>

                        <td class="invert"><?php echo $b['tglorder'] ?></td>
                        <td class="invert">

                            Rp<?php 				$ongkir = 10000;
												$ordid = $b['orderid'];
												$result1 = mysqli_query($conn,"SELECT SUM(qty*harga)+$ongkir AS count FROM detailorder d, produk p where d.orderid='$ordid' and p.idproduk=d.idproduk order by d.idproduk ASC");
												$cekrow = mysqli_num_rows($result1);
												$row1 = mysqli_fetch_assoc($result1);
												$count = $row1['count'];
												if($cekrow > 0){
													echo number_format($count);
													} else {
														echo 'No data';
													}?>

                        </td>

                        <td class="invert">
                            <div class="rem">
                                <?php
								if($b['status']=='Payment'){
								echo '
								<a href="konfirmasi.php?id='.$b['orderid'].'" class="form-control btn-primary">
								Konfirmasi Pembayaran
								</a>
								';}
								else if($b['status']=='Confirmed'){
								echo 'Pesanan Diproses (Pembayaran Diterima)';
								}
								else if($b['status']=='Pengiriman'){
									echo 'Pesanan Dikirim';
								} else if($b['status']=='Selesai'){
									echo 'Pesanan Selesai';
								} else if($b['status']=='Dibatalkan'){
									echo 'Pesanan Dibatalkan';
								} else {
									echo 'Konfirmasi diterima';
								}
								
								?>

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
                        <td class="invert"><?php echo $b['no_resi'] ?></td>
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
        </div>
    </div>
    <!-- //checkout -->
    <!-- //footer -->
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