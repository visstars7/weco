<?php 

$pdo = PDO();
// untuk select option
$pdoStatementCustomer = $pdo->prepare("SELECT * FROM orderDetail ORDER BY nama DESC");
$pdoStatementCustomer->execute();
$select = $pdoStatementCustomer->fetchAll(PDO::FETCH_ASSOC);

$pdoStatementOrders = $pdo->prepare("SELECT * FROM orders ORDER BY nama DESC");
$pdoStatementOrders->execute();
$orders = $pdoStatementOrders->fetchAll(PDO::FETCH_ASSOC);

if(!isset($_POST['select'])){


    $pdoStatementCustomer = $pdo->prepare("SELECT * FROM orderDetail ORDER BY nama DESC");
    $pdoStatementCustomer->execute();
    $customer = $pdoStatementCustomer->fetchAll(PDO::FETCH_ASSOC);

}else{
    $nama_depan = $_POST['customer'];
    // echo $cust_email;

    $pdoStatementCustomer = $pdo->prepare("SELECT * FROM orderDetail WHERE nama_depan = :nama_depan");
    $pdoStatementCustomer->bindParam(":nama_depan",$nama_depan);
    $pdoStatementCustomer->execute();
    $customer = $pdoStatementCustomer->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($customer);
}

// jika pesanan melampaui batas bayar maka di hapus

$date = date("Y-m-d");
$pdoStatementDelTanggal = $pdo->prepare("DELETE FROM tbonproses WHERE NOT tanggal_order = :date && status = '0' ");
$pdoStatementDelTanggal->bindParam(":date",$date);
$pdoStatementDelTanggal->execute();
$no = 1;

?>

<?php if(!empty($customer)): ?>

<div id="frame-nav-product" class="row mt-2">

    <div class="col-md-12 col-sm-12 col-12 float-right">

        <form action="" method="post">

            <div id="frame-search">
            
                <input type="search" class="input-form noto-sans-font" placeholder="Search Customer..">
                <button name="search" class="search-btn noto-sans-font">search</button>

            </div>

            <div id="frame-select">

                <select name="customer" id="wilayah">
                    <?php foreach($select AS $row): ?>
                    <option value="<?=$row['nama_depan']?>"><?= $row['proses_id'] ?></option>
                    <?php endforeach; ?>
                </select>
                
                <button name="select" class="btn btn-md btn-outline-primary noto-sans-font">Select</button>

            </div>

        </form>

    </div>

</div>

<div class="row">


    <div class="table-responsive">


        <table class="table table-striped noto-sans-font mt-2 text-brown">
            
                <tr>
                
                    <th>No.</th>
                    <th>Penerima</th>
                    <th class="text-center">Alamat</th>
                    <th>Kode Pos</th>
                    <th>phone Penerima</th>
                    <th>Kota</th>
                    <th>Kecamatan</th>
                    <th>Provinsi</th>
                    <th>Lihat Invoice</th>

                
                </tr>

                <?php foreach($orders AS $key): ?>

                    <tr>

                        <td><?= $no++ ?></td>
                        <td><?= $key['nama']; ?></td>
                        <td><?= $key['alt_penerima']; ?></td>
                        <td><?= $key['kodepos']; ?></td>
                        <td><?= $key['phone']; ?></td>
                        <td><?= $key['nama_kota']; ?></td>
                        <td><?= $key['nama_kec']; ?></td>
                        <td><?= $key['nama_prov']; ?></td>
                <?php endforeach; ?>
                    <form action="modul/pesananDetail/invoice.php" method="post">
                        <td>

                            <input type="hidden" name="email" value="<?=$select[0]['email']?>">
                            <button class="btn btn-info">Invoice</button>

                        </td>
                    </form>

                    </tr>
        
        </table>

    </div>

        <?php else: ?>

            <div style="justify-content:center" class="row text-center">

                <div style="padding-top:18%;" class="noto-sans-font text-brown">
                
                    <h3 style="text-align:center; justify-content:center;" class="text-center">Maaf,tidak ada pesanan</h3>
                
                </div>

            </div>

        <?php endif; ?>

</div>
