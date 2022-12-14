<?php
session_start();
	if(!isset($_SESSION['logManajer'])){
        echo "Maaf anda tidak memiliki akses";
		echo "<br><meta http-equiv='refresh' content='5; URL=index.php'> You will be redirected to the form in 5 seconds";
	// header('location:login.php');
    } else {
        
    };
	include '../dbconnect.php';

	// $idpembayaran = $_GET["idpembayaran"];
    if(isset($_GET["idpembayaran"])){
        $idpembayaran = $_GET["idpembayaran"];
        $brgs=mysqli_query($conn,"SELECT * from pembayaran  where idpembayaran = $idpembayaran");
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
        move_uploaded_file($tmpName, '..\produk/' . $namafilebaru);
        return $namafilebaru;
    }

    function update($data,$idproduk){
        global $conn;
        global $idpembayaran;
		$metode = $data['metode'];
		$norek = $data['norek'];
		$an = $data['an'];
		
		$imagelama = htmlspecialchars($data["imageLama"]);

        if($_FILES['uploadgambar']['error'] === 4) {
            $image = $imagelama;
            $query = "UPDATE pembayaran SET metode = '$metode', norek = '$norek', an = '$an', logo = '$image' WHERE idpembayaran = $idpembayaran";
            mysqli_query($conn, $query);
        } else {
            $image = upload();
            $query = "UPDATE pembayaran SET metode = '$metode', norek = '$norek', an = '$an', logo = '../images/$image' WHERE idpembayaran = $idpembayaran";
            mysqli_query($conn, $query);
        }
        return mysqli_affected_rows($conn);
    }
	if(isset($_POST["submit"])) {
        // var_dump($_POST);
        // die;
        if(update($_POST,$idproduk) > 0){
            echo "<script> alert('Data Berhasil diedit!');
            document.location.href = 'pembayaran.php';</script>";
        } 
        else {
            //var_dump($data_produk); die;
            echo "<script>alert('Data Gagal diedit!');
            document.location.href = 'edit_pembayaran.php?idproduk=<?=$idpembayaran'?>;</script>";
}
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit Pembayaran - Sipebu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="..\images\logo.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">

    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <!-- <div id="preloader">
        <div class="loader"></div>
    </div> -->
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <img align="center" src="..\images\logo.png" alt="">
                        <ul class="metismenu" id="menu">
                            <li class="active"><a href="index.php"><span>Home</span></a></li>
                            <li><a href="../"><span>Kembali ke Toko</span></a></li>
                            <li>
                                <a href="manageorder.php"><i class="ti-dashboard"></i><span>Kelola Pesanan</span></a>
                            </li>
                            <li>
                                <a href="riwayat.php"><i class="ti-dashboard"></i><span>Pesanan Terselesaikan</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Kelola
                                        Toko
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="kategori.php">Kategori</a></li>
                                    <li><a href="produk.php">Produk</a></li>
                                    <li><a href="pembayaran.php">Metode Pembayaran</a></li>
                                </ul>
                            </li>
                            <li><a href="customer.php"><span>Kelola Pelanggan</span></a></li>
                            <li><a href="user.php"><span>Kelola Staff</span></a></li>
                            <li>
                                <a href="logout.php"><span>Logout</span></a>

                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li>
                                <h3>
                                    <div class="date">
                                        <script type='text/javascript'>
                                        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                                            'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                        ];
                                        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                        var date = new Date();
                                        var day = date.getDate();
                                        var month = date.getMonth();
                                        var thisDay = date.getDay(),
                                            thisDay = myDays[thisDay];
                                        var yy = date.getYear();
                                        var year = (yy < 1000) ? yy + 1900 : yy;
                                        document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                        //-->
                                        </script></b>
                                    </div>
                                </h3>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- page title area end -->
            <div>
                <form class="mx-auto mt-5 d-flex" style="width: 70%;" action="" method="post"
                    enctype="multipart/form-data">
                    <div style="width: 70%;">
                        <input type="hidden" name="imageLama" value="<?= $result["logo"] ?>">
                        <div class="form-group">
                            <label>Nama Metode</label>
                            <input name="metode" type="text" class="form-control" required autofocus
                                value="<?= $result["metode"] ?>">
                        </div>
                        <div class="form-group">
                            <label>No. Rekening</label>
                            <input name="norek" type="text" class="form-control" required
                                value="<?= $result["norek"] ?>">
                        </div>
                        <div class="form-group">
                            <label>Atas Nama</label>
                            <input name="an" type="text" class="form-control" required value="<?= $result["an"] ?>">
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input name="uploadgambar" type="file" class="form-control" value="<?= $result["logo"] ?>">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary mt-3">Add</button>
                    </div>
                    <div class="image mx-4 mt-4"><img src="../<?=$result["logo"]?>" alt="" width="300"></div>

                    <!-- <button type="submit" name="submit" class="btn btn-primary mt-3">Add</button> -->
                </form>
            </div>


            <!-- row area start-->
        </div>
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    <footer>
        <div class="footer-area">
            <p>@JavaButikMuslim</p>
        </div>
    </footer>
    <!-- footer area end-->
    </div>
    <!-- page container area end -->




    <script>
    $(document).ready(function() {
        $('#dataTable3').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'print'
            ]
        });
    });
    </script>

    <!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>