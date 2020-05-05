<?php 

include "../../../helper/helper.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $pdo = PDO();
    $pdoStatementView = $pdo->prepare("SELECT * FROM tbkonfirmasi WHERE konfirmasi_id = :id");
    $pdoStatementView->bindParam(":id",$id);
    $pdoStatementView->execute();
    $tipeGambar = $pdoStatementView->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($tipeGambar);

    foreach($tipeGambar AS $row){
        // var_dump($row['tipe_file']);
        Header("Content-Type:".$row['tipe_file']);
        echo $row['gambar_konfirmasi'];
    }


}else{
    header('Location:'.BASE_URL);
}


?>