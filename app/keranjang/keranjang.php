<?php 

if(!isset($_SESSION['keranjang'])){
    header("Location:index.php?page=home");
}

if(empty($_SESSION['keranjang'])){
    unset($_SESSION['keranjang']);
    header("Location:index.php?page=menu");
}

include 'helper/helper.php';

$user_ID = $_SESSION['user'];
$pdo = PDO();
$pdoStatementInv = $pdo->prepare("SELECT proses_id FROM tbonproses WHERE user_id = :user_id && status = '0'");
$pdoStatementInv->bindParam(':user_id',$user_ID);
$pdoStatementInv->execute();
$result = $pdoStatementInv->fetchAll(PDO::FETCH_ASSOC);
foreach($result AS $row){
    if(!empty($row)){
        $_SESSION['invoice'] = "Maaf bayar dahulu pesanan sebelumnya";
        header('Location:index.php?page=home');
    }
}

$no = 1;

// var_dump($_SESSION['keranjang']);

?>

<div class="table-content table-responsive">

    <table id="table" class="table-hover table table-striped">

        <thead>

                <tr>
                    
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Gambar</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Berat</th>
                    <th>Stok</th>
                    <th>Total Belanja</th>
                    <th class="text-center">Action</th>

                </tr>

        </thead>
        <?php foreach($_SESSION['keranjang'] AS $row): ?>
        <tbody>

                <tr>

                    <td><?= $no ?></td>
                    <td><?= $row['nama_produk'] ?></td>
                    <td><img style="width:100px" src="keranjang/image.php?id=<?=$row['produk_id']?>" alt="<?=$row['nama_produk']?>"></td>
                    <td><input style="width:50px" name="<?=$row['produk_id']?>" class="text-center qty" type="number" value="<?= $row['qty'] ?>"></td>
                    <td><?= rupiah($row['harga']) ?></td>
                    <td><?= $row['berat']*$row['qty']; ?></td>
                    <td><?= $row['stok'] ?></td>
                    <td><?= rupiah($row['qty']*$row['harga']); ?></td>
                    <td class="text-center">
                        <a class="btn btn-success" href="index.php?page=order&id=<?=$row['produk_id']?>">beli</a> |
                        <a class="btn btn-danger" href="keranjang/deleteKeranjang.php?id=<?=$row['produk_id']?>">hapus</a>
                    </td>

                </tr>

        </tbody>
        <?php $no++; ?>
        <?php endforeach; ?>

    </table>

    <div class="table-footer">
        
        <a class="btn btn-success" href="index.php?page=order">Beli Semua</a>
        <a class="btn btn-danger"  href="keranjang/deleteKeranjang.php?status=semua">Hapus Semua</a>

    </div>

</div>

<script>

    $("document").ready(function(){

        $(".qty").on("input",function(e){
    
            var data = $(this).val();
            var id = $(this).attr('name');
            // console.log(data);
            $.ajax({
                type:"POST",
                data:"qty="+data+"&id="+id,
                url:"keranjang/updateKeranjang.php",
                success:function(result){
                    // console.log(result);
                    window.location.reload();
                    var parseData = JSON.parse(result);
                    return alert(parseData.pesan);
                }
            });
    
        });

    });



</script>