<?php 

$pdo = PDO();
$pdoStatementCustomer = $pdo->prepare("SELECT * FROM orderDetail ORDER BY nama DESC");
$pdoStatementCustomer->execute();
$select = $pdoStatementCustomer->fetchAll(PDO::FETCH_ASSOC);

if(!isset($_POST['select'])){

    $pdo = PDO();
    $pdoStatementCustomer = $pdo->prepare("SELECT * FROM orderDetail ORDER BY nama DESC");
    $pdoStatementCustomer->execute();
    $customer = $pdoStatementCustomer->fetchAll(PDO::FETCH_ASSOC);

}else{
    $nama_depan = $_POST['customer'];
    // echo $cust_email;
    $pdo = PDO();
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
            
                <input type="search" class="input-form noto-sans-font" placeholder="Search Pesanan..">
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
                    <th>Nama Pemesan</th>
                    <th>Email</th>
                    <th>Nomor</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                    <th>Keterangan</th>
                
                </tr>

            <?php foreach($customer AS $row ): ?>

                <tr>

                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_depan'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><img style="width:100px" src="modul/pesanan/gambar.php?id=<?= $row['proses_id'] ?>" alt="<?= $row['nama_produk']; ?>"></td>


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

                    <td><a class="btn btn-danger" href="modul/pesanan/batalkan.php?id=<?=$row['proses_id']?>">Batalkan</a></td>
                    <td><a href="#" class="btn btn-<?=$color?>"><?= $status ?></a></td>
                
                </tr>
            
            <?php endforeach; ?>
        
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
