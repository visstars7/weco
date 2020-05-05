<?php 

session_start();

include_once "../helper/helper.php";

// total bayar dari pembelian session_user
$userID = intval($_SESSION['user']);

$pdo = PDO();
$pdoStatementProsesID = $pdo->prepare("SELECT * FROM tbonproses WHERE user_id = :user_id ");
$pdoStatementProsesID->bindParam(":user_id",intval($userID));
$pdoStatementProsesID->execute();
$prosesID = $pdoStatementProsesID->fetchAll(PDO::FETCH_ASSOC);


// proses Id dari session user jika terdapat lebih dari 1 barang pilih salah satu barang
foreach($prosesID AS $row){

    if($row > 1){

        $proses = intval($prosesID[0]['proses_id']);
        $total = intval($row['total']);

    }
}

// untuk menampilkan select bank
$pdoStatementBank = $pdo->prepare("SELECT * FROM tbbank WHERE status='on'");
$pdoStatementBank->execute();
$Bank = $pdoStatementBank->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['bank'])){
    
    // var_dump($_FILES);

    // ambil semua data yang diinputkan user
    $bank = intval($_POST['bank']);
    $noRek = intval($_POST['no_rek']);
    $gambar = file_get_contents($_FILES['gambar_transfer']['tmp_name']);
    $tipeFile = $_FILES['gambar_transfer']['type'];
    $besarFile = $_FILES['gambar_transfer']['size'];
    $tanggal = date("Y-m-d H:i:s");

    if($tipeFile !== "image/jpeg")
    {
        $_SESSION['alert'] = "maaf,tipe gambar tidak sesuai";
        echo "gagal";
        Header('Location:buktiPembayaran.php');
    }
    elseif($besarFile > 5000000)
    {
        $_SESSION['alert'] = "maaf,ukuran gambar terlalu besar";
        echo "gagal";
        Header('Location:buktiPembayaran.php');
    }
    else
    {

        // melakukan insert dahulu
        $sql = "INSERT INTO tbkonfirmasi (`konfirmasi_id`,`proses_id`,`bank_id`,`no_rek`,`total_bayar`,`tanggal_konfirmasi`,`gambar_konfirmasi`,`tipe_file`,`status`) VALUES (NULL,:proses_ID,:bank,:noRek,:totalBayar,:tanggal,:gambar,:type_file,'on')";
        // var_dump($tanggal);
        
        $pdoStatementInsert = $pdo->prepare($sql);
        $pdoStatementInsert->bindParam(":proses_ID",intval($proses));
        $pdoStatementInsert->bindParam(":bank",intval($bank));
        $pdoStatementInsert->bindParam(":noRek",intval($noRek));
        $pdoStatementInsert->bindParam(":totalBayar",intval($total));
        $pdoStatementInsert->bindParam(":tanggal",$tanggal);
        $pdoStatementInsert->bindParam(":gambar",$gambar);
        $pdoStatementInsert->bindParam(":type_file",$tipeFile);
        if($pdoStatementInsert->execute()){
            // lalu setelah insert berhasil, update status proses Order menjadi sedang divalidasi
            $pdoStatementUpdate = $pdo->prepare("UPDATE tbonproses SET status='1' WHERE user_id = $userID");
            if($pdoStatementUpdate->execute()){
                echo "success";
                Header('Location:../myprofile/modul/pesananAnda/invoice.php');
            }else{
                $_SESSION['alert'] = "maaf,gagal update";
                echo "gagal";
                Header('Location:buktiPembayaran.php');
            }

        }else{
            $_SESSION['alert'] = "maaf,gagal insert";
            echo "gagal";
            Header('Location:buktiPembayaran.php');
        }
    }

}


?>