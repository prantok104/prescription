<?php include('header.php');
include('../db.php');
?>



<header class="admin-bar-areas">
    <a href="../index.php"><i class="fa fa-bars"></i> MENU</a>
</header>
<section class="admin-area-start">
    <div class="admin-menu-area">
        <?php include('menu.php');?>
    </div><!-- Admin menu end-->
    <div class="admin-area">
       <h1 class="text-center text-uppercase text-primary">Problem Show Tab</h1>
        <div class="prbolem-show-area">
            <ul class="pbl-menu">
               <?php
                    $showApps = "SELECT * FROM fevername";
                    $showResult = mysqli_query($db,$showApps);
                    while($showRow = mysqli_fetch_array($showResult)){
                        echo '<li><a href="problemedit.php?illid='.$showRow['id'].'" class="btn btn-primary text-uppercase">'.$showRow['name'].'</a></li>';
                    }
                ?>
            </ul>
        </div>
    </div><!-- Admin area end-->
</section>
<?php include('footer.php');?>
