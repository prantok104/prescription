<?php 
include('db.php');
include('header.php');

/*
 ** Modal form use for illness name and add the picture   
 ** Code for Insert illnes
*/
$val = '';
if(isset($_POST['btn-submit'])){
        
        $imageName = $_FILES['image']['name'];
        $imageData = mysqli_real_escape_string($db, file_get_contents($_FILES['image']['tmp_name']));
        $imageType = $_FILES['image']['type'];

        $pname = $_POST['illname'];

        if(empty($pname) || empty($imageData)){
            $val = 1;
        }else{
            $sql = "SELECT * FROM feverName WHERE name = '".$pname."'";
            $result = $db->query($sql);
            $row = $result->num_rows;
            if($row >=1){
                $val = 2;
            }else{
                if(substr($imageType,0,5) == 'image'){
                    $sql ="INSERT INTO  feverName(name, icon, icontype) VALUES ('$pname','$imageData','$imageType')";

                    $result = $db->query($sql);
                    if($result){
                        $val = 3;
                    }
                }
            }
        }
}

if($val == ''){
    
}elseif($val == 1){
    echo '<p class="alert alert-danger">Something is missing !</p>';
}elseif($val == 2){
    echo '<p class="alert alert-danger">Fever name already exist !</p>';
}elseif($val == 3){
    echo '<p class="alert alert-success">Insert Successfully Completed .</p>';
}

?>
<!--Header Top area start-->
<header class="admin-bar-area">
    <div class="admin-links">
        <div class="col-md-2 col-xs-6">
            <div class="mode-link">
                <a href="../mehedi/"><i class="fa fa-bars"></i> Mode</a>
            </div>
        </div>
        <div class="col-md-10 col-xs-6">
            <div class="admin-link">
                <a href="admin/index.php">admin</a>
            </div>
        </div>
    </div>
</header>
<!--Header Top area end-->

<!--Header area start-->
<section class="apps-area-start">
<div class="container">
    <div class="row">
        <div class="apps-area">
            <div class="apps-display">
                <div class="all-apps-area">
                   <?php
                        $sql = "select * from fevername";
                        $result = $db->query($sql);
                        $row = $result->num_rows;
                        if($row ==0){
                            echo ' Have No Fever List';
                        }else{
                            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                echo '<div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="single-apps">
                                            <a href="admin/addpatient.php?fid='.$row['id'].'"><img src="ajaxfile.php?imid='.$row['id'].'" alt="virus">'.$row['name'].'</a>
                                        </div>
                                    </div>'; 
                            }
                        }
                    
                    ?>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <div class="single-apps">
                            <a href="" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus"></i></a>
                        </div>
                    </div> <!--Single apps end-->
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!--Header area end-->

<!--Modal area start-->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-plus"></i> Add Illness </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-form">
                    <form action="" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="size" value="1000000">
                        <label for="image"><img src="assets/img/virus/illimage.png" alt="">
                           <input type="file" name="image" id="image" placeholder="Add image">
                           Add Virus Picture
                        </label>
                        
                        <input type="text" name="illname" id="illname" placeholder="Illness name" class="form-control">
                        
                        <button type="submit" class="btn btn-primary" name="btn-submit">Add Illness</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <p class="bg-danger text-center">All * mark shuld be fill up ! </p>
            </div>
        </div>
    </div>
</div>
<!--Modal area end-->


<?php include('footer.php');?>
<script>
$('.alert').click(function(){
   $('.alert').hide(); 
});
</script>
