<?php
session_start();
if(!isset($_SESSION['logManajer'])){
        echo "Maaf anda tidak memiliki akses";
		echo "<br><meta http-equiv='refresh' content='5; URL=index.php'> You will be redirected to the form in 5 seconds";
	// header('location:login.php');
    } else {
        
    };

	include '../dbconnect.php';

    function delete_produk($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM produk WHERE idproduk = $id;");
        return mysqli_affected_rows($conn);
    }
    function delete_pegawai($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM login WHERE userid = $id");
        return mysqli_affected_rows($conn);
    }
    function delete_user($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM login WHERE userid = $id");
        return mysqli_affected_rows($conn);
    }
    
    $id = $_GET["id"];
    $tabel = $_GET["q"];
    
    if($tabel == 'produk'){
        // var_dump($id);
        // var_dump($tabel);
        // die;
        // $result = mysqli_query($conn, "DELETE FROM produk WHERE idproduk = $id;");
        // mysqli_fetch_assoc($result);
        // var_dump($result);
        // die;
        if(delete_produk($id) > 0){
        echo "<script>
            alert('Data Berhasil dihapus!');
            document.location.href = 'produk.php';
        </script>";
        } 
        else {
            echo "<script>
                alert('Data Gagal dihapus!');
                document.location.href = 'produk.php';
            </script>";
        }
    } 
    if($tabel == 'pegawai'){
        // var_dump($id);
        // var_dump($tabel);
        // die;
        if(delete_pegawai($id) > 0){
        echo "<script>
            alert('Data Berhasil dihapus!');
            document.location.href = 'user.php';
        </script>";
        } 
        else {
            echo "<script>
                alert('Data Gagal dihapus!');
                document.location.href = 'user.php';
            </script>";
        }
    }
    if($tabel == 'user'){
        // var_dump($id);
        // var_dump($tabel);
        // die;
        if(delete_user($id) > 0){
        echo "<script>
            alert('Data Berhasil dihapus!');
            document.location.href = 'user.php';
        </script>";
        } 
        else {
            echo "<script>
                alert('Data Gagal dihapus!');
                document.location.href = 'user.php';
            </script>";
        }
    }
    // if(delete_produk($id) < 0){
    //     echo "<script>
    //         alert('Data Berhasil dihapus!');
    //         document.location.href = 'produk.php';
    //     </script>";
    // } else {
    //     echo "<script>
    //         alert('Data Gagal dihapus!');
    //         document.location.href = 'produk.php';
    //     </script>";
    // }

    
?>