<?php
    include('header.php');
    include('../db.php');
    $showmdecineSlq = "SELECT * FROM medecine WHERE id ='".$_GET['editmedecineid']."'";
    $showMedecineResult = mysqli_query($db,$showmdecineSlq );
    $showMedecineRow = mysqli_fetch_array($showMedecineResult);
    
// Update Code Medecine in medecine page modal

if(isset($_POST['medecine-update'])){
    $medecineUpdateSql = "UPDATE medecine SET name = '".$_POST['medecine-name']."' , category = '".$_POST['medecine-category']."' WHERE id = '".$_GET['editmedecineid']."'";
    $medecineUpdateResult = mysqli_query($db, $medecineUpdateSql);
    if($medecineUpdateResult){
        header('location:medecine.php');
    }
    else{
        echo '(: (: Something is missing !';
    }
}  
?>
<section class="edit-medecine-area">
    <div class="container">
        <div class="row">
            <div class="edit-medcine-middle">
                <h1>Edit : <?php echo $showMedecineRow['name'];?> </h1>
                <form action="" method="POST">
                    <input type="hidden" name="editid" id="editid" value="<?php echo $showmedecinerow['id'];?>">
                    <select name="medecine-category" id="medecine-category" class="medecine-category">
                        <option value="all">Select Medecine Category</option>
                        <option value="Tablet">Tablet</option>
                        <option value="capsule">capsule</option>
                        <option value="ointment">ointment</option>
                        <option value="sympoo">sympoo</option>
                        <option value="syrup">syrup</option>
                    </select>
                    <input type="text" name="medecine-name" id="medecine-name" placeholder="Medecine Name" class="form-control" value="<?php echo $showMedecineRow['name'];?>">
                    <button type="submit" class="btn btn-sm btn-primary" name="medecine-update"> <i class="fa fa-pencil-square-o"></i> Update Medecine</button>
                </form>
            </div>
        </div>
    </div>
</section>