<?php include('header.php');
      include('../db.php');
$output='';
if(isset($_POST['pro-btn'])){
    $illness = $_POST['illness'];
    $problem= $_POST['problem'];
    if($illness =='' || $problem ==''){
        $output = '<p class="text-center bg-center">(:(: Something is Missing !</p>';
    } else{
        $findid = "SELECT MAX(id) as id FROM allproblem";
        $findidResult = mysqli_query($db, $findid);
        $findidRow = mysqli_fetch_array($findidResult);
        $countid = $findidRow['id']+1;
        
        $problemmatchsql = "SELECT * FROM allproblem WHERE  problem ='".$problem."'";
        $problemmatchResult = mysqli_query($db,$problemmatchsql);
        $problemmatchrow = mysqli_num_rows($problemmatchResult);
        if($problemmatchrow >=1){
            echo '<h1 class="bg-success text-center text-uppercase">Problem Exiest</h1>';
        } else{
            $problemSql = "INSERT INTO allproblem VALUES('".$countid."','".$illness."','".$_POST['icon']."','".$problem."')";
            $problemResult = mysqli_query($db, $problemSql);
            if($problemResult){
                echo '<h1 class="bg-success text-center text-uppercase">Insert Sucessfully Completed</h1>';
            }
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
    <div class="admin-area">
        <h1 class="bg-danger text-center text-uppercase"><?php echo $output;?></h1>
        <div class="problem-form">
           <h1 class="text-center">Problem Form</h1>
            <form action="" method="POST">
                <select name="illness" id="illness">
                    <option value="">Select option</option>
                    <option value="1">chronic glossitis</option>
                    <option value="2">dhat syndrome</option>
                    <option value="3">alopecia universalis</option>
                    <option value="4">av</option>
                    <option value="5">ede pe</option>
                    <option value="6">dh</option>
                    <option value="7">tinea corporis</option>
                    <option value="8">melasma</option>
                    <option value="9">seb. dermatitis</option>
                    <option value="10">dermatitis</option>
                    <option value="11">herpes zoster</option>
                    <option value="12">bar</option>
                    <option value="13">lotion</option>
                    <option value="14">spray</option>
                    <option value="15">injection</option>
                </select>
                <label for="icon"><img src="../assets/img/delta.png" alt="" style="width:30px; height:30px"><input name="icon" id="icon" value="1" type="radio"></label>
                <label for="icon2"><img src="../assets/img/rx.png" alt="" style="width:30px; height:30px"><input name="icon" id="icon2" value="2" type="radio"></label>
                <input type="text" name="problem" id="problem" placeholder="Problem" class="form-control" autocomplete="off">
                <button type="submit" class="btn btn-primary" name="pro-btn">Click Here</button>
            </form>
        </div>
    </div><!-- Admin area end-->
</section>
<?php include('footer.php');?>
