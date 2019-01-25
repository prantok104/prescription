<?php
include('header.php');
include('../db.php');
if($_GET['fid']){
    $getfid = $_GET['fid'];
    $sql1 = "SELECT  fevername.id as feverid , fevername.name as fevername, count(patient.id) as maxid, max(patient.id) as pid FROM fevername left join patient on fevername.id = patient.fid WHERE fevername.id = '$getfid'";
    $result1 = $db->query($sql1);
    $row1 = $result1->fetch_array(MYSQLI_ASSOC);
}

// for patinet Insert code
$val = '';
if(isset($_POST['add-patient'])){
    $name =  $_POST['pname'];
    $yrs =  $_POST['yrs'];
    $fid =  $_POST['fid'];

    if(empty($name) || empty($yrs) || empty($fid)){
        $val = 1;
    }else{
        $sql = "SELECT * FROM patient WHERE name = '".$name."' AND age ='".$yrs."'";
        $result = $db->query($sql);
        $row = $result->num_rows;
        if($row >=1){
            $val = 2;
        }else{
            $result =  $db->query("INSERT INTO patient(`name`,`age`,`fid`) VALUES('$name','$yrs','$fid')");
            if($result){
                $pidresult = $db->query("SELECT max(id) as id FROM patient");
                $pidrow = $pidresult->fetch_array(MYSQLI_ASSOC);
                $patientid = $pidrow['id'];
                $location = 'location:../profile.php?fid='.$getfid.'&pid='.$patientid;
                header($location);
            }
        }
    }
}


$pid = $row1['maxid'] + 1;
?>
<section class="edit-medecine-area">
    <div class="container">
        <div class="row">
            <div class="search-patint-area">
               <h1 class="text-uppercase">Find patient by using ID</h1>
                <form action="" method="POST">
                    <input type="hidden" name="fid" id="fid" value="<?php echo $row1['feverid'];?>">
                    <input type="text" name="searchid" id="searchid" placeholder="Patient ID" class="form-control">
                </form>
                <table class="table table-hover table-bordered table-responsive text-center">
                   <thead class="bg-success">
                       <tr>
                           <th class="text-center text-uppercase">name</th>
                           <th class="text-center text-uppercase">age</th>
                           <th class="text-center text-uppercase">date</th>
                           <th class="text-center text-uppercase">action</th>
                       </tr>
                   </thead>
                    <tbody id="sw-pat">
                    </tbody>
                </table>
            </div>
            <div class="edit-medcine-middle">
                <h1>Add Patient for <?php echo $row1['fevername']?></h1>
                <div class="modal-body">
                    <div class="modal-form">
                        <form action="" method="POST">
                            <input type="text"  value="<?php echo substr($row1['fevername'],0,3).$pid;?>" class="small-input">
                            <input type="hidden" name="fid" id="fid" value="<?php echo $row1['feverid'];?>">
                            <label for=""><?php echo 'Date : '. date('d-M-Y');?></label>
                            <input type="text" name="pname" id="pname" placeholder="Patient Name" class="form-control">
                            <input type="text" name="yrs" id="yrs" placeholder="yrs" class="form-control">
                            <button type="submit" class="btn btn-danger" name="add-patient">Click Here</button>
                            <a href="../index.php" class="btn btn-primary btn-sm">Home</a>
                            <?php
                                if($val == ''){

                                }elseif($val == 1){
                                    echo '<p class="alert alert-danger">Something is missing !</p>';
                                }elseif($val == 2){
                                    echo '<p class="alert alert-danger">Patient Already Exist !</p>';
                                }
                            ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php');?>
<script>
    $(document).ready(function(){
        $('#searchid').keyup(function(){
            var searchid = $('#searchid').val();
            var fid = $('#fid').val();
            if(searchid !='' && fid !=''){
                $.ajax({
                    url:'functions.php',
                    method:'POST',
                    data:{searchid:searchid , fid:fid},
                    success:function(data){
                        $('#sw-pat').html('');
                        $('#sw-pat').html(data);
                    }
                });
            }
        });
});
</script>
