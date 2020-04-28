<?php 

session_start();

if(isset($_GET['status'])){
    unset($_SESSION['keranjang']);
    header('Location:../index.php?page=home');
}elseif(isset($_GET['id'])){
    $id = $_GET['id'];
    $keranjang = $_SESSION['keranjang'];
    unset($keranjang[$id]);
    $_SESSION['keranjang'] = $keranjang;
    header('Location:../index.php?page=home');
}else{
    header('Location:../index.php?page=home');
}

?>