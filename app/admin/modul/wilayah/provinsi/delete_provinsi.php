<?php 

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $conn = conn();
    mysqli_query($conn,"DELETE FROM tbprovinsi WHERE prov_id = $id");
    $_SESSION['message'] = "<script>alert('data provinsi berhasil terhapus')</script>";
    header('Location:index.php?page=wilayah');

}else{
    header('Location:index.php?page=wilayah');
}

?>