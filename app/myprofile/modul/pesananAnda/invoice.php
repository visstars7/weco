<?php 

include_once "../../../helper/helper.php";
session_start();
$pdo = PDO();

if(!isset($_SESSION['user'])){
    header("Location:../../../index.php?page=home");
}

$userID = intval($_SESSION['user']);
$pdoStatementViewUser = $pdo->prepare("SELECT email FROM tbuser WHERE user_id = :userID");
$pdoStatementViewUser->bindParam(":userID",$userID);
$pdoStatementViewUser->execute();
$fetch = $pdoStatementViewUser->fetchAll(PDO::FETCH_ASSOC);

$email = $fetch[0]['email'];

// $order_id =  intval($pdo->lastInsertId());
// echo $order_id;

$pdoStatementViewOrder = $pdo->prepare("SELECT * FROM orderDetail WHERE email = :email");
$pdoStatementViewOrder->bindParam(":email",$email);
$pdoStatementViewOrder->execute();
$order = $pdoStatementViewOrder->fetchAll(PDO::FETCH_ASSOC);

$pdoStatementViewBank = $pdo->prepare("SELECT * FROM tbbank WHERE status ='on'");
$pdoStatementViewBank->execute();
$Bank = $pdoStatementViewBank->fetchAll(PDO::FETCH_ASSOC);

$hari_terakhir = date('d')+1;

$totalBelanja = 0;
$totalBerat = 0;


// $user_ID = $_SESSION['user'];
// $_SESSION['invoice'] = true;

$no = 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../../../../resource/img/Weco.png" type="image/x-icon">
    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="../../../../resource/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="../../../../resource/css/invoice.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>Invoice</title>
</head>
<body>
    
<div class="container">

    <div class="row" id="btn">
    
        <button class=" mt-2 ml-2 btn btn-info">Print</button>
        <button class=" mt-2 ml-2 btn btn-info">Export as PDF</button>

        <div class="underlined"></div>

    </div>

    <div class="row">
    
        <div class="col-md-6 col-6">
        
            <img width="150px" src="../../../../resource/img/output-onlinepngtools.png" alt="logo-kopi">

        </div>

        <div class="col-md-6 col-6 kiri">

            <p><span>Jl.jayengkusuma</span></p>
            <p>(62)896-1213-5741</p>
            <p>weecoffe@weco.com</p>
        
        </div>

        <div class="underlined"></div>

    </div>

    <div class="row">
    
        <div class="col-md-4 col-4  kanan">
        
            <p>Invoice To: </p>
            <p> <span><?= $order[0]['nama'] ?></span></p>
            <p><?= $order[0]['email']; ?></p>
            <p><?= $order[0]['alt_penerima'] ?></p>
        
        </div>
    
        <div class="col-md-4 col-4 text-center mt-5">

            <?php 
            
            
                switch($order[0]['status']){
                    case 0: 
                        $status = "Belum Bayar";
                        $color  = "danger";
                        break;
                    case 1: 
                        $status = "Sedang diverifikasi";
                        $color  = "primary";
                        break;
                    case 2: 
                        $status = "terbayar";
                        $color  = "success";
                        break;
                    case 3: 
                        $status = "Sedang Dikirim";
                        $color  = "info";
                        break;
                }
            
            
            ?>

            <a href="../../myprofile.php?page=statusPembayaran" class="btn btn-<?=$color?>"><?= $status ?></a>
        
        </div>
    
        <div class="col-md-4 col-4" id="kanan">
            <p><span>INVOICE ID <?= $order[0]['proses_id']; ?></span></p>
            <p>Date invoice: <?= $order[0]['tanggal_order']; ?></p>
            <p>Terakhir invoice: <?= date('Y-m-').$hari_terakhir;?></p>
        
        </div>
    
    </div>

    <div class="row">
    
        <table class="table table-striped">
        
            <thead>
            
                <tr>
                
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Berat</th>
                    <th>Total</th>
                
                </tr>
            
            </thead>

            <tbody>
                <?php foreach($order AS $row): ?>
                <tr>
                    
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_produk'] ?></td>
                    <td><?= rupiah($row['harga']); ?></td>
                    <td><?= $row['qty']; ?></td>
                    <td><?= $row['berat']*$row['qty']; ?></td>
                    <td><?= rupiah($row['harga']*$row['qty']); ?></td>
                    <?php $totalBelanja += $row['harga'] * $row['qty']; ?>
                    <?php $totalBerat += $row['berat'] * $row['qty']; ?>
                </tr>
                <?php endforeach; ?>
            
            </tbody>

        </table>
    
    </div>

    <div class="row">
    
        <div class="col-md-8 col-8  pembayaran">
        
            <span>Untuk pembayaran menggunakan metode transfer:</span>
            <?php foreach($Bank AS $row): ?>
            <p class="mt-2">No Rek: <?= $row['rekening'] ?></p>
            <p>Bank: <?= $row['nama_bank'] ?></p>
            <?php endforeach; ?>

        </div>

        <div class="col-md-4 col-4">
        
            <div class="row">
            
                <p>Subtotal: <?= rupiah($totalBelanja); ?></p>

                <div class="underlined"></div>
            
            </div>

            <div class="row">
            
                <p>Ongkir: <?= rupiah($totalBerat*900); ?></p>
                <div class="underlined"></div>
            
            </div>
                
            <div class="row mt-2 mb-3">
            
                <a href="../../../buktiPembayaran/buktiPembayaran.php" class="btn btn-info">Kirim bukti transfer</a>
            
            </div>

        </div>

    </div>


</div>

<script src="../../../../resource/popper/popper.min.js" ></script>
<script src="../../../../resource/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
</body>
</html>