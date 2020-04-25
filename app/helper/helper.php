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

function rupiah ($data){
    $rupiah = "Rp.".number_format($data)."-,";
    return $rupiah;
}

function upload($file){
    // $conn = conn();
    // filtering
    
    if($file['size'] !== 0){
        #extention validation
        $data = $file['type'];
        
        if($data !== "image/jpeg" AND $data !== "image/png"){
            return 1;
        }
        #size validation
        elseif($file['size'] > 500000){
            return 2;
        }
        #error info
        elseif($file['error'] > 0){   
            return 3;
        }else{
            
            $image = addslashes(file_get_contents($file['tmp_name']));
            
            return $image;
            
        }
        
        // move To Images
        // return file path
        
    }
    else{
        
        $image = addslashes(file_get_contents($file['tmp_name']));
        
        return $image;
        
    }
    
}


// PDO

function PDO() {

    $server = 'localhost';
    $dbname = 'weco';
    $user = 'root';
    $password = '';
    $koneksiPDO = new PDO("mysql:host=$server;dbname=$dbname",$user,$password);
    return $koneksiPDO;

}

?>