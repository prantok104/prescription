<?php 
include('header.php');
include('../db.php');
$editid = $_GET['fid'];
if(isset($_POST['btn-submit'])){
    
    
    
    $imageName = $_FILES['image']['name'];
    $imageData = mysqli_real_escape_string($db, file_get_contents($_FILES['image']['tmp_name']));
    $imageType = $_FILES['image']['type'];

    $pname = $_POST['illname'];

    if(empty($pname)){
        echo '<p class="bg-danger" id="msg-close">Something is wrong !</p>';
    }else{
        $updatesql = "UPDATE fevername set name='".$pname."' , icon = '".$imageData."' , icontype = '".$imageType."' WHERE id = '".$editid."'";
        $updateresult = mysqli_query($db, $updatesql);
    }
}

$imagesql = "SELECT * FROM fevername WHERE id ='".$editid."'";
$imageresult = mysqli_query($db,$imagesql);
$imageshow = mysqli_fetch_array($imageresult);





?>
<header class="admin-bar-areas">
    <a href="../index.php"><i class="fa fa-bars"></i> MENU</a>
</header>
<section class="admin-area-start">
    <div class="admin-menu-area">
        <?php include('menu.php');?>
    </div><!-- Admin menu end-->
    <div class="admin-area">
        <div class="modal-form">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="size" value="<?php echo $editid;?>" id="editid">
                <label for="image"><img src="../ajaxfile.php?imid=<?php echo $imageshow['id'];?>" alt="">
                    <input type="file" name="image" id="image">
                    Add Virus Picture
                </label>

                <input type="text" name="illname" id="illname" placeholder="Illness name" class="form-control" value="<?php echo $imageshow['name'];?>">
                <button type="submit" class="btn btn-primary" name="btn-submit" id="btn-submit">Update</button>
                
            </form>
        </div>
    </div><!-- Admin area end-->
</section>
<?php include('footer.php');?>



