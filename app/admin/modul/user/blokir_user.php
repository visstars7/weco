<?php 

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = conn();

    if(mysqli_query($conn,"UPDATE tbuser SET `status` = 'off' WHERE user_id = $id")){

        Header('Location:index.php?page=user&pesan=2');

    }

}
else{
    Header('Location:index.php?page=user');
}

?>