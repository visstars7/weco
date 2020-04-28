<?php

include_once '../helper/helper.php';

session_start();

    if(isset($_POST['qty'])){

        $pdo = PDO();
        
        
        $qty= $_POST['qty'];
        $id = $_POST['id'];
        
        // menampilkan stok
        $pdoStatementStok = $pdo->prepare("SELECT stok FROM tbproduk WHERE produk_id = :id");
        $pdoStatementStok->bindParam(":id",$id);
        $pdoStatementStok->execute();
        $result = $pdoStatementStok->fetchAll(PDO::FETCH_ASSOC);
        
        
        // $keranjang = $_SESSION['keranjang'];
        // $keranjang[$id]["qty"] = $qty;
        // $_SESSION['keranjang'] = $keranjang;
        
        // // echo json_encode("pesan"=>["berhasil"]);
        
        // echo json_encode(["pesan"=>"berhasil"]);
        
        
        
        foreach($result AS $row){
            
            if($qty > $row['stok'] || $qty < 0 || $qty == ""){
    
                echo json_encode(["pesan"=>"Maaf,stok melampaui batas"]);
    
            }else{
                
                $keranjang = $_SESSION['keranjang'];
        
                $keranjang[$id]["qty"] = $qty;
        
                $_SESSION['keranjang'] = $keranjang;
        
                // echo json_encode("pesan"=>["berhasil"]);
        
                echo json_encode(["pesan"=>"berhasil"]);
            }
            
            
        }




    }

?>