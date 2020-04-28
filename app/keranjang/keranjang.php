<?php 

if(!isset($_SESSION['keranjang'])){
    header("Location:index.php?page=home");
}

include 'helper/helper.php';

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
                    <td><?= $row['berat'] ?></td>
                    <td><?= $row['stok'] ?></td>
                    <td><?= rupiah($row['qty']*$row['harga']); ?></td>
                    <td class="text-center">
                        <a class="btn btn-success" href="#">beli</a> |
                        <a class="btn btn-danger" href="keranjang/deleteKeranjang.php?id=<?=$row['produk_id']?>">hapus</a>
                    </td>

                </tr>

        </tbody>
        <?php $no++; ?>
        <?php endforeach; ?>

    </table>

    <div class="table-footer">
        
        <a class="btn btn-success" href="#">Beli Semua</a>
        <a class="btn btn-danger"  href="keranjang/deleteKeranjang.php?id=<?=$row['produk_id']?>&status=semua">Hapus Semua</a>

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
                    var parseData = JSON.parse(result);
                    window.location.reload();
                    // return alert(parseData.pesan);
                }
            });
    
        });

    });



</script>