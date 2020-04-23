<?php 

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = conn();
    mysqli_query($conn,"DELETE FROM tbkecamatan WHERE kec_id=$id");
    if(mysqli_affected_rows($conn)){
        $_SESSION['message'] = "<script>alert('Data kecamatan telah dihapus')</script>";
        Header('Location:index.php?page=wilayah');
    }
}else{
    $_SESSION['message'] = "<script>alert('Gagal menghapus data kecamatan')</script>";
    Header('Location:index.php?page=wilayah');
}

?>