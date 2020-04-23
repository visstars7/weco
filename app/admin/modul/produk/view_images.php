<?php 


if(isset($_GET['id'])){
    
    include_once '../../../helper/helper.php';

    $conn = conn();

    $id = $_GET['id'];

    $sql = "SELECT * FROM tbproduk WHERE produk_id = $id";

    $query = mysqli_query($conn,$sql);

    $row = mysqli_fetch_assoc($query);
    header("Content-type:".$row['tipe_file']);
    echo $row['gambar'];

}else{
    Header('Location:index.php');
}

?>