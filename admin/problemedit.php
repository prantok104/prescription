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
        <div class="prbolem-show-area">
            <div class="pbl-display-edit">
                <div class="pbl-table-edit">
                   <h1 class="text-center text-uppercase">Problem list</h1>
                    <ul class="pbl-edit">
                        <?php
                            $showApps = "SELECT * FROM allproblem WHERE pid ='".$_GET['illid']."'";
                            $showResult = mysqli_query($db,$showApps);
                            $count = 1;
                            $row = mysqli_num_rows($showResult);
                            if($row<1){
                                echo '<h1 class="text-center text-uppercase">Problem are no exiest</h1>';
                            }
                            while($showRow = mysqli_fetch_array($showResult)){
                                if($showRow['icon']==1){
                                    echo '<li><span>'.$count++.'.</span><img src="../assets/img/delta.png">'.$showRow['problem'].'<a href="editpbl.php?pid='.$showRow['id'].'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i>Edit</a>
                                    <a href="problemedit.php?pblid='.$showRow['id'].'&illid='.$_GET['illid'].'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>Delete</a></li>';
                                } else{
                                    echo '<li><span>'.$count++.'.</span><img src="../assets/img/rx.png">'.$showRow['problem'].'<a href="editpbl.php?pid='.$showRow['id'].'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i>Edit</a>
                                    <a href="problemedit.php?pblid='.$showRow['id'].'&illid='.$_GET['illid'].'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>Delete</a></li>';
                                }
                            }
                        
                        
                            // Delete Code for problem from editpbl.php

                            if(isset($_GET['pblid'])){
                                $pblid = $_GET['pblid'];
                                $pbldelete = "DELETE FROM allproblem WHERE id = $pblid";
                                $pbldeleteResult = mysqli_query($db,$pbldelete);
                                if($pbldeleteResult){
                                    $location = 'location:problemedit.php?illid='.$_GET['illid'];
                                    header($location);
                                }
                            } 
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- Admin area end-->
</section>
<?php include('footer.php');?>
