<?php 

if(isset($_GET['id'])){
    include_once '../helper/helper.php';
    $id = $_GET['id'];
    $conn = conn();
    $query = mysqli_query($conn,"SELECT * FROM tbproduk WHERE produk_id = $id");
    $row = mysqli_fetch_assoc($query);
    Header('Content-type:'.$row['tipe_file']);
    echo $row['gambar'];
}else{
    Header('Location:index.php?page=home');
}


?>