<?php 

include_once '../helper/helper.php';

if(file_exists("controller.php")){

    include_once "controller.php";
}

if(isset($_SESSION['alert'])){
    // var_dump($_SESSION['alert']);
    $pesan = $_SESSION['alert'];
    echo "<script>alert('$pesan')</script>";
    unset($_SESSION['alert']);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Transaksi</title>
     <!-- bootstrap 4 -->
     <link rel="stylesheet" href="../../resource/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="../../resource/css/admin.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="../../resource/img/Weco.png" type="image/x-icon">
</head>
<body>

    <div class="container">


        <div class="row">
        
        
            <div class="col-md-12">
            
            
                <form action="controller.php" method="POST" enctype="multipart/form-data">

                    <div class="form-group mt-5">
                        <label for="bank">Pilih Bank</label>
                        <select class="custom-select" name="bank" id="bank">
                                <?php foreach($Bank AS $row): ?>
                                    <option value="<?=$row['bank_id']?>"><?= $row['nama_bank'] ?></option>
                                <?php endforeach; ?>
                        </select>
                    
                    </div>

                    <div class="form-group">
                    
                        <label for='no_rek'>Nomor Rekekening</label>
                        <input class="form-control" type='number' name='no_rek' id='no_rek' placeholder='Masukkan Nomer Rekening Anda' required>

                    </div>


                    <div class="custom-file mb-3">
                    
                        <label class="custom-file-label" for='total_bayar'>Bukti Gambar Transfer</label>
                        <input class="custom-file-input" type='file' name='gambar_transfer' id='transfer'>

                    </div>

                    <div class="form-group">
                    
                        <button name="submit" class="btn btn-primary btn-block">Submit</button>

                    </div>
                
                </form>
                
            </div>
        
        
        </div>


    </div>

<script src="../../resource/jquery-3.4.1.min.js" ></script>
<script src="../../resource/popper/popper.min.js" ></script>
<script src="../../resource/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    
</body>
</html>
