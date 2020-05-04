<?php 

include_once "../../../helper/helper.php";



// $pdoStatementDelTanggal = $pdo->prepare("DELETE FROM tbonproses");
// $pdoStatementDelTanggal->bindParam(":id",$id);
// $pdoStatementDelTanggal->execute();

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $pdo = PDO();
    $pdoStatementDel = $pdo->prepare("DELETE FROM tbonproses WHERE proses_id = :id");
    $pdoStatementDel->bindParam(":id",$id);
    if($pdoStatementDel->execute()){
        header('Location:../../index.php?page=pesanan');
    }

}else{

    header('Location:../../index.php?page=pesanan');
}




?>