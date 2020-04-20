<?php 


?>

<div id="main-frame-insert">
    <form action="" method="post" enctype="multipart/form-data">

        <div id="header-form form-group noto-sans-font">
        
            <h3 class="w-50">Insert Product</h3>

        </div>

        <div class="content-form form-group">

            <input class="form-control w-50" type='text' name='product' placeholder='Nama Product'>

        </div>

        <div class="content-form form-group">

            <select class="form-control w-50" name="kategori" id="kategori">

                <option value="kategori">Kategori</option>

            </select>

        </div>

        <div class="content-form form-group">

            <textarea class="form-control w-50" name="deskripsi" id="deskripsi">Masukan Deskripsi</textarea>

        </div>

        <div class="content-form form-group">

            <input type='file' class="form-control-file w-50">

        </div>

        <div class="content-form form-group">

            <input class="form-control w-50" type='number' name='harga' placeholder='Harga'>

        </div>

        <div class="content-form form-group">

            <input class="form-control w-50" type='number' name='stok' placeholder='stok'>

        </div>
        
        <div class="content-form">

            <button class="btn btn-success w-50" name="submit" >Submit</button>

        </div>

    </form>


</div>