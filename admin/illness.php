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
            <table class="table table-responsive table-hover table-striped table-bordered text-center">
                <thead class="bg-danger">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <body class="patient-list">
                   <?php 
                    $illsql = "SELECT * FROM fevername";
                    $illresult = mysqli_query($db, $illsql);
                    $rowcount = 1;
                    while($illrow = mysqli_fetch_array($illresult)){
                        echo '<tr>
                                <td>'.$rowcount++.'</td>
                                <td>'.$illrow['name'].'</td>
                                <td><img src="../ajaxfile.php?imid='.$illrow['id'].'" alt=""></td>
                                <td>
                                    <a href="illedit.php?fid='.$illrow['id'].'" class="btn btn-primary btn-xs" ><i class="fa fa-pencil-square-o"></i>Edit</a>
                                    <a href="functions.php?appsid='.$illrow['id'].'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
                                </td>
                            </tr>
                        ';
                    }
                    ?>
                </body>
            </table>
        </div>
    </div><!-- Admin area end-->
</section>
<?php include('footer.php');?>

    
