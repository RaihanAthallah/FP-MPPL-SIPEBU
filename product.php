<?php
session_start();
include 'dbconnect.php';

$idproduk = $_GET['idproduk'];

if(isset($_POST['addprod'])){
	if(!isset($_SESSION['log']))
		{	
			header('location:login.php');
		} else {
				$ui = $_SESSION['id'];
				$cek = mysqli_query($conn,"select * from cart where userid='$ui' and status='Cart'");
				$liat = mysqli_num_rows($cek);
				$f = mysqli_fetch_array($cek);
				$orid = $f['orderid'];
				
				//kalo ternyata udeh ada order id nya
				if($liat>0){
							
							//cek barang serupa
							$cekbrg = mysqli_query($conn,"select * from detailorder where idproduk='$idproduk' and orderid='$orid'");
							$liatlg = mysqli_num_rows($cekbrg);
							$brpbanyak = mysqli_fetch_array($cekbrg);
                            if(isset($brpbanyak['qty'])){
                                $jmlh = $brpbanyak['qty'];
                            }
                            else{
                                $jmlh = 1;
                            }
							
							
							//kalo ternyata barangnya ud ada
							if($liatlg>0){
								$i=1;
								$baru = $jmlh + $i;
								
								$updateaja = mysqli_query($conn,"update detailorder set qty='$baru' where orderid='$orid' and idproduk='$idproduk'");
								
								if($updateaja){
									echo " <div class='alert alert-success'>
								Barang sudah pernah dimasukkan ke keranjang, jumlah akan ditambahkan
							  </div>
							  <meta http-equiv='refresh' content='1; url= product.php?idproduk=".$idproduk."'/>";
								} else {
									echo "<div class='alert alert-warning'>
								Gagal menambahkan ke keranjang
							  </div>
							  <meta http-equiv='refresh' content='1; url= product.php?idproduk=".$idproduk."'/>";
								}
								
							} else {
							
							$tambahdata = mysqli_query($conn,"insert into detailorder (orderid,idproduk,qty) values('$orid','$idproduk','1')");
							if ($tambahdata){
							echo " <div class='alert alert-success'>
								Berhasil menambahkan ke keranjang
							  </div>
							<meta http-equiv='refresh' content='1; url= product.php?idproduk=".$idproduk."'/>  ";
							} else { echo "<div class='alert alert-warning'>
								Gagal menambahkan ke keranjang
							  </div>
							 <meta http-equiv='refresh' content='1; url= product.php?idproduk=".$idproduk."'/> ";
							}
							};
				} else {
					
					//kalo belom ada order id nya
						$oi = crypt(rand(22,999),time());
						
						$bikincart = mysqli_query($conn,"insert into cart (orderid, userid) values('$oi','$ui')");
						
						if($bikincart){
							$tambahuser = mysqli_query($conn,"insert into detailorder (orderid,idproduk,qty) values('$oi','$idproduk','1')");
							if ($tambahuser){
							echo " <div class='alert alert-success'>
								Berhasil menambahkan ke keranjang
							  </div>
							<meta http-equiv='refresh' content='1; url= product.php?idproduk=".$idproduk."'/>  ";
							} else { echo "<div class='alert alert-warning'>
								Gagal menambahkan ke keranjang
							  </div>
							 <meta http-equiv='refresh' content='1; url= product.php?idproduk=".$idproduk."'/> ";
							}
						} else {
                            var_dump($oi);
                            var_dump(mysqli_error($conn));
                            die;
							echo "gagal bikin cart";
						}
				}
		}
};
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sipebu - Produk</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" /> -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">

    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- //js -->
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
                        <a class="nav-link" href="#">Rekomendasi</a>
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


    <div class="produk mt-4 pt-8">
        <div class="container py-3">
            <div class="row">
                <?php 
				$p = mysqli_fetch_array(mysqli_query($conn,"Select * from produk where idproduk='$idproduk'"));
				// echo $p['namaproduk'];
				?>
                <div class="col-sm-6 col-lg-4 mb-4 ">
                    <img id="example" src="<?php echo $p['gambar']?>" alt=" " class="" width="100%" max-height="500px">
                </div>
                <div class="col-sm-6 col-lg-4 ">
                    <h1><?php echo $p['namaproduk'] ?></h1>
                    <div class="w3agile_description">
                        <h4>Deskripsi :</h4>
                        <p><?php echo $p['deskripsi'] ?></p>
                    </div>
                    <div class="snipcart-item block">
                        <div class="snipcart-thumb agileinfo_single_right_snipcart">
                            <h4 class="m-sing">Rp<?php echo number_format($p['harga']) ?>

                            </h4>
                        </div>
                        <div class="snipcart-details agileinfo_single_right_details">
                            <form action="#" method="post">
                                <fieldset>
                                    <input type="hidden" name="idprod" value="<?php echo $idproduk ?>">
                                    <input type="submit" name="addprod" value="Add to cart"
                                        class="btn btn-outline-secondary">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>

    <?php
            $brgs=mysqli_query($conn,"SELECT * from produk order by idproduk ASC");
            $no=1;
            while($p=mysqli_fetch_array($brgs)){                                      
    ?>

    <div class="container">
        <h1 align="center">KOLEKSI TOKO LAINNYA</h1>
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
                                                src="<?php echo $p['gambar']?>" width="200px" height="300px"></a>
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

    <!-- <div class="container">
        <div class="my-4 py-4 " align="center">
            <h2 class="mx-4 headline">Koleksi Toko</h2>
        </div>
        <div class="row">
            <?php $i = 1; ?>
            <?php foreach($brgs as $row) : ?>
            <div
                class="col-lg-3 col-sm-4 d-flex flex-column align-items-center justify-content-center product-item my-3">
                <div class="product">
                    <img src="<?= $row["gambar"]?>" alt="" width="230px" height="270px">
                </div>
                <div class="title pt-4 pb-1"><?= $row["namaproduk"]?></div>
                <div class="price">
                    <h4 class="">Rp.<?php echo number_format($row['harga']) ?>

                    </h4>
                </div>
                <div class="snipcart-details top_brand_home_details">
                    <fieldset>
                        <a href="product.php?idproduk=<?php echo $row['idproduk'] ?>"><input type="submit"
                                class="btn btn-danger" value="Lihat Produk" /></a>
                    </fieldset>
                </div>
            </div>
            <?php $i++; ?>
            <?php endforeach ?>
        </div>
    </div> -->

    <!-- //footer -->

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