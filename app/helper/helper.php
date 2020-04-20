<?php 

function baseURL(){
    define("BASE_URL","http://localhost/wecoffe");
}

function conn(){
    $conn = mysqli_connect('localhost','root','','weco');
    return $conn;
}

function getAll($sql){
    $koneksi = conn();
    $table = mysqli_query($koneksi,$sql);
    $data = [];
    while($temp = mysqli_fetch_assoc($table)){
        $data[] = $temp;
    }
    return $data;
}

?>