<?php 

session_start();

if(isset($_SESSION['user'])){

    unset($_SESSION['user']);
    unset($_SESSION['nama']);
    unset($_SESSION['keranjang']);
    header('Location:../index.php?page=home');

}else{
    header('Location:../index.php?page=home');
}

?>