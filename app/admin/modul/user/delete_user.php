<?php 

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = conn();
    if(mysqli_query("DELETE FROM tbuser WHERE user_id = $id")){
        Header('Location:index.php?page=user&pesan=3');
    }
}else{
    Header('Location:index.php?page=user');
}

?>