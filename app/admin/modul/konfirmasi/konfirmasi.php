<?php

$pdo = PDO();

// menampilkan semua id yang di pesan customer
$pdoStatementOrderDetail = $pdo->prepare("SELECT orderDetail.*,konfirmasi.total_bayar,konfirmasi.no_rek,konfirmasi.gambar_konfirmasi,konfirmasi.konfirmasi_id,konfirmasi.nama_bank,konfirmasi.tanggal_konfirmasi FROM orderDetail JOIN konfirmasi ON orderDetail.email = konfirmasi.email");
$pdoStatementOrderDetail->execute();
$orderDetail = $pdoStatementOrderDetail->fetchAll(PDO::FETCH_ASSOC);
// apa yang dipesan customer (nama produk)
// berapa harganya (total harga yang dibeli customer + ongkir)


// bukti pembayaran (noRek,Harga Yang Diinputkan,GambarTransfer)
$pdoStatementConfirm = $pdo->prepare("SELECT * FROM konfirmasi");
$pdoStatementConfirm->execute();
$konfirmasi = $pdoStatementConfirm->fetchAll(PDO::FETCH_ASSOC);

// var_dump($orderDetail);

$filename = isset($_GET['list']) ? "modul/konfirmasi/".$_GET['list'].".php" : false;

$i = 1;

if(isset($_SESSION['alert'])){
    $pesan = $_SESSION['alert'];
    echo "<script>alert('$pesan')</script>";
    unset($_SESSION['alert']);
}

?>
<?php if($filename == false): ?>
<div id="frame-nav-product" class="row mt-2">

<div class="col-md-12 col-sm-12 col-12 float-right">

    <form action="" method="post">

        <div id="frame-search">
        
            <input type="search" class="input-form noto-sans-font" placeholder="Search Pembayaran..">
            <button name="search" class="search-btn noto-sans-font">search</button>

        </div>

        <div id="frame-select">

            <select name="customer" id="wilayah">
                <?php foreach($orderDetail AS $row): ?>
                <option value="<?=$row['nama_depan']?>"><?= $row['konfirmasi_id'] ?></option>
                <?php endforeach; ?>
            </select>
            
            <button name="select" class="btn btn-md btn-outline-primary noto-sans-font">Select</button>

        </div>

    </form>

</div>

</div>
<?php endif; ?>

<div class="row mt-3">

    <div class="table-responsive">
        <?php if(file_exists($filename)): ?>
            <?php include_once $filename; ?>
        <?php else: ?>
        <table class="table table-striped table-hover ubuntu-font text-brown">
        
            <tr>
            
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Nama Produk</th>
                <th>Total Harga</th>
                <th>No Rekening</th>
                <th>Nama Bank</th>
                <th>Tanggal Terkonfirmasi</th>
                <th>Gambar Konfirmasi</th>
                <th>Status</th>
                <th>Edit</th>
            
            </tr>

            <?php $berat = 0 ?>
            <?php foreach($orderDetail AS $row): ?>
            <?php $berat = $row['berat']*$row['qty'] + $berat ?>

                    <?php 
                        
                        switch($row['status']){
                            case 0 :
                                $status = "belum bayar";
                                $color = "warning";
                                break;
                            case 1:
                                $status = "sedang diverifikasi";
                                $color = "primary";
                                break;
                            case 2:
                                $status = "sudah dibayar";
                                $color = "success";
                                break;
                            case 3:
                                $status = "sedang dikirim";
                                $color = "info";
                                break;
                        }
                    
                    ?>

                    <tr>

                        <td><?= $row['konfirmasi_id'] ?></td>
                        <td><?= $row['nama_depan'] ?></td>
                        <td><?= $row['nama_produk'] ?></td>
                        <td><?= rupiah(intval($row['total']*$berat)) ?></td>
                        <td><?= $row['no_rek']?></td>                    
                        <td><?= $row['nama_bank']?></td>                    
                        <td><?= $row['tanggal_konfirmasi']?></td>                    
                        <td><img style="width:100px" src="modul/konfirmasi/gambar_view.php?id=<?=$row['konfirmasi_id']?>" alt=""></td>                    
                        <td><a href="#" class="btn btn-<?=$color?>"><?= $status?></a></td>
                        <td><a href="?page=konfirmasi&list=edit_konfirmasi&id=<?=$row['proses_id']?>" class="btn btn-info">Edit</a></td>
                    
                    </tr>
                    <?php $i++ ?>
            <?php endforeach; ?>
        
        </table>
        <?php endif; ?>


    </div>
</div>