<?php
session_start();

if(!isset($_SESSION['logManajer'])){
        echo "Maaf anda tidak memiliki akses";
		echo "<br><meta http-equiv='refresh' content='5; URL=index.php'> You will be redirected to the form in 5 seconds";
	// header('location:login.php');
    } else {
        
    };

include '../dbconnect.php';
include './assets/fpdf/fpdf.php';
//menyertakan file fpdf, file fpdf.php di dalam folder FPDF yang diekstrak
// include "fpdf/fpdf.php";
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf->AddPage();
// menyetel font yang digunakan, font yang digunakan adalah arial, bold dengan ukuran 16
$pdf->SetFont('Arial','B',16);
// judul
$pdf->Cell(190,7,'BUTIK JAVA MUSLIM FASHION',0,1,'C');
$pdf->SetFont('Arial','B',12);

if($_GET['data']='riwayat'){
    $pdf->Cell(190,7,'RIWAYAT PEMBELIAN',0,1,'C');
 
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(10,7,'',0,1);
    
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,6,'NOMOR',1,0);
    $pdf->Cell(30,6,'ID PESANAN',1,0);
    $pdf->Cell(50,6,'NAMA CUSTOMER',1,0);
    $pdf->Cell(50,6,'TANGGAL ORDER',1,0);
    $pdf->Cell(35,6,'TOTAL BELANJA',1,1);
    
    $pdf->SetFont('Arial','',10);

    $no = 1;

        $brgs=mysqli_query($conn,"SELECT * from cart c, login l where c.userid=l.userid and status='Selesai' order by idcart ASC");
        $no=1;
        while($p=mysqli_fetch_array($brgs)){
        $orderids = $p['orderid'];
        
        $pdf->Cell(20,6,$no++,1,0);
        $pdf->Cell(30,6,$p['orderid'],1,0);
        $pdf->Cell(50,6,$p['namalengkap'],1,0);
        $pdf->Cell(50,6,$p['tglorder'],1,0);

        $result1 = mysqli_query($conn,"SELECT SUM(d.qty*p.harga) AS count FROM detailorder d, produk p where orderid='$orderids' and p.idproduk=d.idproduk order by d.idproduk ASC");
        $cekrow = mysqli_num_rows($result1);
        $row1 = mysqli_fetch_assoc($result1);
        $count = $row1['count'];
        if($cekrow > 0){
        $pdf->Cell(35,6,$count,1,1);
        } else {
            echo 'No data';
        }
    }
    
    $pdf->Output();
    }
if($_GET['data']='staff'){
    $pdf->Cell(190,7,'RIWAYAT PEMBELIAN',0,1,'C');
 
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(10,7,'',0,1);
    
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,6,'NOMOR',1,0);
    $pdf->Cell(30,6,'NAMA',1,0);
    $pdf->Cell(50,6,'EMAIL',1,0);
    $pdf->Cell(50,6,'TELEPON',1,0);
    $pdf->Cell(35,6,'ALAMAT',1,1);
    
    $pdf->SetFont('Arial','',10);

    $no = 1;

        $brgs=mysqli_query($conn,"SELECT * from cart c, login l where c.userid=l.userid and status='Selesai' order by idcart ASC");
        $total_penjualan= mysqli_query($conn, "SELECT SUM(d.qty*p.harga) AS count FROM detailorder d, produk p,cart where d.orderid=cart.orderid and p.idproduk=d.idproduk and cart.status='selesai' order by d.idproduk ASC;");
        $no=1;
        while($p=mysqli_fetch_array($brgs)){
            $orderids = $p['orderid'];
            
            $pdf->Cell(20,6,$no++,1,0);
            $pdf->Cell(30,6,$p['orderid'],1,0);
            $pdf->Cell(50,6,$p['namalengkap'],1,0);
            $pdf->Cell(50,6,$p['tglorder'],1,0);

            $result1 = mysqli_query($conn,"SELECT SUM(d.qty*p.harga) AS count FROM detailorder d, produk p where orderid='$orderids' and p.idproduk=d.idproduk order by d.idproduk ASC");
            
            $cekrow = mysqli_num_rows($result1);
            $row1 = mysqli_fetch_assoc($result1);
            $count = $row1['count'];
            if($cekrow > 0){
            $pdf->Cell(35,6,$count,1,1);
            } else {
                echo 'No data';
            }
        }
        $pdf->Cell(190,7,"TOTAL PENJUALAN = '$total_penjualan'",0,1,'C');
    
    $pdf->Output();
    }
//membuat objek baru bernama pdf dari class FPDF
//dan melakukan setting kertas l : landscape, A5 : ukuran kertas

// $pdf->Cell(190,7,'DAFTAR PRODUK TERDAFTAR',0,1,'C');
 
// // Memberikan space kebawah agar tidak terlalu rapat
// $pdf->Cell(10,7,'',0,1);
 
// $pdf->SetFont('Arial','B',10);
// $pdf->Cell(20,6,'NOMOR',1,0);
// $pdf->Cell(70,6,'NAMA PRODUK',1,0);
// $pdf->Cell(35,6,'KATEGORI',1,0);
// $pdf->Cell(25,6,'STOK',1,1);
 
// $pdf->SetFont('Arial','',10);

// // include "config.php";
// // //koneksi ke database
// // $conn = new mysqli("localhost","root","","sipebu");
// $no = 1;
// $tampil = mysqli_query($conn, "select * from produk");
// while ($hasil = mysqli_fetch_array($tampil)){
//     $pdf->Cell(20,6,$no++,1,0);
//     $pdf->Cell(70,6,$hasil['namaproduk'],1,0);
//     $pdf->Cell(35,6,$hasil['harga'],1,0);
//     $pdf->Cell(25,6,$hasil['stok'],1,1); 
// }
 
// $pdf->Output();

?>


<!DOCTYPE html>
<html>

<head>
    <title>EXPORT DATA</title>
</head>