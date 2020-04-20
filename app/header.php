
<?php 

$menu_active = $page == "menu" ? "active" : ""; 
$keranjang_active = $page == "keranjang" ? "active" : ""; 
$home_active = $page == "home" ? "active" : ""; 
$login_active = $page == "login" ? "active" : ""; 
$myprofile = $page == "myprofile" ? "active" : "";
$kontak_active = $page == "kontak_active" ? "active" : "";


$header_md = isset($_SESSION['user']) ? "6" :"7";

?>

<header>

    <div class="row">

        <div class="col-md-<?=$header_md?> col-sm-<?=$header_md?>">
            
            <div id="logo-header">

                <a href="../index.php">
                
                    <img class="image-fluid" src="../resource/img/output-onlinepngtools.png" alt="image-logo">

                </a>
    
            </div>
            
        </div>

        <div class="col-md-1 top col-sm-1 nav-item ">
            
            <div id="contact-us">
    
                <a class=" <?=$kontak_active?> ubuntu-font" href="#">Contac Us</a>
    
            </div>
            
        </div>

        <div class="col-md-1 top col-sm-1 nav-item ">
            <div id="nav-coffe">
    
                <a class=" text-center <?=$home_active?> ubuntu-font" href="index.php?page=home">Home</a>
    
            </div>
            
        </div>

        <div class="col-md-1 top col-sm-1 nav-item ">
            
            <div id="menu">
                <a class=" ubuntu-font <?=$menu_active?>" href="index.php?page=menu">Menu</a> 
    
            </div>
            
        </div>

        <div class="col-md-1 top col-sm-1 nav-item ">

            <div id="keranjang">

                <a class=" <?=$keranjang_active?> ubuntu-font" href="#">Keranjang</a>

            </div>

        </div>

        <?php if(isset($_SESSION['user'])): ?>

            <div class="col-md-1 top col-sm-1 nav-item ">

                <div id="login">

                    <a class=" ubuntu-font"  onclick="return confirm('yakin mau logout?')"href="logout/logout.php">logout</a>

                </div>

            </div>

            <div class="col-md-1 top col-sm-1 nav-item ">

                <div id="myprofile">

                    <a class=" <?=$myprofile?>ubuntu-font" href="myprofile/myprofile.php">Myprofile</a>

                </div>

            </div>

        <?php else: ?>
        
            <div class="col-md-1 top col-sm-1 nav-item ">

                <div id="login">

                    <a class=" <?=$login_active?> ubuntu-font" href="login/login.php">login</a>

                </div>

            </div>

        <?php endif; ?>

    </div>

</header>