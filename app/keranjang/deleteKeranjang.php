<?php 

session_start();

if(isset($_GET['id']) && isset($_GET['status']) ){
    unset($_SESSION['keranjang']);
    header('Location:../index.php?page=home');
}elseif(isset($_GET['id'])){
    $id = $_GET['id'];
    $keranjang = $keranjang['keranjang'];
    unset($_SESSION[$id]);
    $_SESSION['keranjang'] = $keranjang;
    header('Location:../index.php?page=home');
}else{
    header('Location:../index.php?page=home');
}

?>