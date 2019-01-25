<?php 
    include('header.php');
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
        <div class="patient-table">
            <div class="prbolem-show-area">
                <ul class="pbl-menu">
                    <?php
                    $showApps = "SELECT * FROM fevername";
                    $showResult = $db->query($showApps);
                    while($showRow = $showResult->fetch_array(MYSQLI_ASSOC)){
                        echo '<li><a href="patient.php ?fid='.$showRow['id'].'" class="btn btn-primary text-uppercase">'.$showRow['name'].'</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div><!-- Admin area end-->
</section>
<?php include('footer.php');?>




