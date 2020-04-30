<?php 

include_once '../helper/helper.php';

$pdo = PDO();

session_start();


if(!isset($_SESSION['user']) || !isset($_SESSION['keranjang'])){
    Header('Location:../index.php?page=home');
}else{
    
    if(isset($_POST['penerima'])){
        $nama = htmlspecialchars($_POST['penerima']);
        $nomor =  htmlspecialchars($_POST['nomor']);
        $alamat =  htmlspecialchars($_POST['alamat']);
        $kec =  htmlspecialchars($_POST['kecamatan']);
        $kota =  htmlspecialchars($_POST['kota']);
        $prov =  htmlspecialchars($_POST['provinsi']);
        $kodePos =  htmlspecialchars($_POST['kodepos']);
        $harga = 0;
        
        $pdoStatementInsert = $pdo->prepare("INSERT INTO tborder (`order_id`,`nama`,`alt_penerima`,`kota_id`,`prov_id`,`kec_id`,`kodepos`,`phone`) VALUES (NULL,:nama,:alamat,:kota,:prov,:kec,:kodePos,:phone)");
        
        $pdoStatementInsert->bindParam(":nama",$nama);
        $pdoStatementInsert->bindParam(":phone",$nomor);
        $pdoStatementInsert->bindParam(":alamat",$alamat);
        $pdoStatementInsert->bindParam(":kec",$kec);
        $pdoStatementInsert->bindParam(":kota",$kota);
        $pdoStatementInsert->bindParam(":prov",$prov);
        $pdoStatementInsert->bindParam(":kodePos",$kodePos);
        
        if($pdoStatementInsert->execute()){
            $orderId =  intval($pdo->lastInsertId());
            echo $harga;
            $jam =  date("h");
            $jam +=1;
            $jamTanggal = date("Y-m-d");
            $userID = intval($_SESSION['user']);
            
            if(isset($_POST['id'])){
                $id = $_POST['id'];
                // echo $id;
                $harga = intval($_SESSION['keranjang'][$id]['harga']*$_SESSION['keranjang'][$id]['qty']);
                $produkID = intval($_SESSION['keranjang'][$id]['produk_id']);
                $qty = $_SESSION['keranjang'][$id]['qty'];
                $pdoStatementInsert  = $pdo->prepare("INSERT INTO tbonproses (`proses_id`,`produk_id`,`order_id`,`user_id`,`qty`,`total`,`tanggal_order`,`status`) VALUES (NULL,:produkID,:orderId,:userID,:qty,:harga,:jamTanggal,'0')");
                $pdoStatementInsert->bindParam(":produkID",intval($produkID));
                $pdoStatementInsert->bindParam(":orderId",intval($orderId));
                $pdoStatementInsert->bindParam(":userID",intval($userID));
                $pdoStatementInsert->bindParam(":qty",intval($qty));
                $pdoStatementInsert->bindParam(":harga",intval($harga));
                $pdoStatementInsert->bindParam(":jamTanggal",$jamTanggal);
                if($pdoStatementInsert->execute()){
                    unset($_SESSION['keranjang'][$id]);
                    Header('Location:checkout.php');
                }else{
                    echo "gagal";
                }
            }
            else{

                foreach($_SESSION['keranjang'] AS $key => $value){
                    $harga += intval($value['harga']*$value['qty']);
                }
                
                foreach ($_SESSION['keranjang'] AS $key => $value){
                    $produkID = intval($value['produk_id']);
                    $harga;
                    $qty = $value['qty'];
                    $pdoStatementInsert  = $pdo->prepare("INSERT INTO tbonproses (`proses_id`,`produk_id`,`order_id`,`user_id`,`qty`,`total`,`tanggal_order`,`status`) VALUES (NULL,:produkID,:orderId,:userID,:qty,:harga,:jamTanggal,'0')");
                    $pdoStatementInsert->bindParam(":produkID",intval($produkID));
                    $pdoStatementInsert->bindParam(":orderId",intval($orderId));
                    $pdoStatementInsert->bindParam(":userID",intval($userID));
                    $pdoStatementInsert->bindParam(":qty",intval($qty));
                    $pdoStatementInsert->bindParam(":harga",intval($harga));
                    $pdoStatementInsert->bindParam(":jamTanggal",$jamTanggal);
                    if($pdoStatementInsert->execute()){
                        echo "sukses";
                    }else{
                        echo "gagal";
                    }      
                }
                unset($_SESSION['keranjang']);
                Header('Location:checkout.php');
            }

        }else{
            Header('Location:../index.php?page=home');
        }
    
    }else{
        Header('Location:../index.php?page=home');
    }
}


?>