<?php 

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = conn();
    mysqli_query($conn,"DELETE FROM tbproduk WHERE produk_id = $id");
    header('Location:index.php?page=produk&pesan=1');
}

?>