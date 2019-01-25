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
        <table class="medecine-table table table-reponsive table-striped table-hover text-center">
            <thead class="bg-primary">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Medecine</th>
                    <th class="text-center">Order</th>
                    <th class="text-center">Time</th>
                    <th class="text-center">Day</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $id = $_GET['illid'];
                    $query = "SELECT * FROM allmedecine WHERE feverid = '".$id."'";
                    $result = mysqli_query($db,$query);
                    $count = 1;
                    while($row = mysqli_fetch_array($result)){
                        echo '
                            <tr>
                                <td>'.$count++.'</td>
                                <td>'.$row['medecine'].'</td>
                                <td>'.substr($row['orders'],1,140).'...</td>
                                <td>'.$row['time'].'</td>
                                <td>'.$row['day'].'</td>
                                <td><a href="illeditmede.php?mid='.$row['id'].'&illid='.$id.'" class="btn btn-xs bg-primary"><i class="fa fa-pencil-square-o"></i>Edit</a>
                                <a href="functions.php?delme='.$row['id'].'&illid='.$id.'" class="btn btn-xs bg-danger"><i class="fa fa-pencil-square-o"></i>Delete</a></td>
                            </tr>
                        ';
                }
                ?>
                
            </tbody>
        </table>
    </div><!-- Admin area end-->
</section>
<?php include('footer.php');?>
