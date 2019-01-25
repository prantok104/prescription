<?php 
include('header.php');
include('../db.php');
// Patient Show function
$fid =  $_GET['fid'];
function getThePatient($fid){
    include('../db.php');
    $sql ="SELECT patient.id as id, patient.name as name, fevername.name as fname, patient.age as age, patient.datetimes as datetimes FROM patient right join fevername on patient.fid = fevername.id WHERE fid='$fid' ORDER BY patient.id DESC";
    $result = $db->query($sql);
    $row = $result->num_rows;
    $count = 1;
    if($row <=0){
        echo '<p class="alert alert-danger">Have no Patient</p>';
    }
    else{
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo '
                <tr>
                    <td>'.$count++.'</td>
                    <td>'.substr($row['fname'],0,3).$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['age'].'</td>
                    <td>'.$row['datetimes'].'</td>
                    <td>
                        <a href="editpatient.php?fid='.$fid.'&pid='.$row['id'].'" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
                    </td>
                </tr>
            ';
        }
    }
}


?>
<header class="admin-bar-areas">
    <a href="../index.php"><i class="fa fa-bars"></i> MENU</a>
</header>
<section class="admin-area-start">
    <div class="admin-menu-area">
        <?php include('menu.php');?>
    </div><!-- Admin menu end-->
    <div class="admin-area patient-table">
<!--
        <form action="" method="POST">
            <input type="text" name="psearch" id="psearch" placeholder="Patient ID or Patient Name" class="form-control">
            <button type="button" class="btn btn-xs"><i class="fa fa-search"></i></button>
        </form>
-->
        <table class="table table-responsive table-hover table-striped table-bordered text-center">
            <thead class="bg-danger">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <body class="patient-list">
               <?php
                    getThePatient($fid);
                ?>
            </body>
        </table>
    </div><!-- Admin area end-->
</section>
<?php include('footer.php');?>