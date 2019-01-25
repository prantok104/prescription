<?php 
    include('header.php');
    include('db.php');

$getfid = $_GET['fid'];
$getpid = $_GET['pid'];

    if(isset($_POST['pbl-btn'])){
        $icon = $_POST['icon'];
        $problemName = $_POST['problem'];
        if(empty($icon) || empty($problemName)){
            $val = 1;
        }else{
            $sql = "SELECT * FROM patientproblem WHERE problemName = '".$problemName."' AND patientid = '".$getpid."'";
            $result = $db->query($sql);
            $row = $result->num_rows;
            if($row >=1){
                $val = 2;
            }else{
                $result = $db->query("INSERT INTO patientproblem(`problemName`,`icon`,`patientId`) VALUES('$problemName','$icon','$getpid')");
            }
        }
    }
    
    function gettheproblem($getpid){
        include('db.php');
        $result = $db->query("SELECT * FROM patientproblem WHERE patientid='$getpid'");
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            if($row['icon'] == 1){
                echo '<li><img src="assets/img/delta.png" alt=""> <span>'.$row['problemName'].'</span></li>';
            }else{
                echo '<li><img src="assets/img/rx.png" alt=""> <span>'.$row['problemName'].'</span></li>';
            }
        }
    }

    function getTheMedecine($getfid){
        include('db.php');
        $sql = "SELECT * FROM allmedecine left join fevername on allmedecine.feverid = fevername.id WHERE allmedecine.feverid = '$getfid'";
        $result = $db->query($sql);
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo '<li>
                    <span>'.$row['medecine'].'<b class="text-primary"> দিন: '.$row['day'].' দিন</b></span>
                    <span>'.$row['orders'].'</span> 
                    <strong class="text-primary pull-right">নির্দেশমত: '.$row['time'].'</strong> 
                </li>';
        }
    }
    
    function getTheInsertMedecine($getpid){
        include('db.php');
        $getfid = $_GET['fid'];
        $sql = "SELECT * FROM prescribe WHERE pid = '$getpid'";
        $result = $db->query($sql);
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo '<li id="'.$row['id'].'">
                    <span>'.$row['medecine'].'<b class="text-primary"> দিন: '.$row['days'].' দিন</b></span>
                    <span>'.$row['orders'].'</span> 
                    <strong class="text-primary pull-right">নির্দেশমত: '.$row['time'].'</strong> ';?>
                    <a href="admin/functions.php?bid=<?php echo $row['id'];?>&fid=<?php  echo $getfid;?>&pid=<?php echo $getpid;?>" class="btn btn-xs">&times;</a>
                <?php 
            echo ' </li> ';
        }
    }

    $val = '';
 
    if($_GET['fid']){
        $getfid = $_GET['fid'];
        $getpid = $_GET['pid'];
        $sql = "SELECT  fevername.id as feverid , fevername.name as fevername, count(patient.id) as maxid, max(patient.id) as pid, patient.name as pname, patient.age as age, patient.datetimes as times FROM fevername left join patient on fevername.id = patient.fid WHERE fevername.id = '$getfid' AND patient.id = '$getpid'";
        $result = $db->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
    }
    
if($val == ''){

}elseif($val == 1){
    echo '<p class="alert alert-danger">Something is missing !</p>';
}elseif($val == 2){
    echo '<p class="alert alert-danger">Problem name already exist !</p>';
}
?>
<header class="menu-area">
    <div class="col-md-1">
        <a href="admin">Admin</a>
    </div> <!--Single item End-->
    <div class="col-md-2">
        <div class="menu-link">
            <a href=""><i class=" fa fa-bars"></i> MODE</a>
        </div>
    </div> <!--Single item End-->
    <div class="col-md-2">
        <div class="menu-link">
            <a href="index.php"><i class=" fa fa-home"></i> HOME</a>
        </div>
    </div> <!--Single item End-->
</header>

<!--Prescribe area start-->
<section class="prescribe-area-start">
    <div class="prescribe-area">
        <div class="pre-headar">
            <div class="pre-dif text-left">
                <strong>ID: </strong> <span><?php echo substr($row['fevername'],0,3).$getpid;?></span>
                <strong>Name: </strong> <span><?php echo $row['pname'];?></span>
            </div>
            <div class="pre-dif text-right">
                <strong>Yrs: </strong> <span><?php echo $row['age'];?></span>
                <strong>Date: </strong> <span><?php echo substr($row['times'],0,10);?></span>
            </div>
        </div><!-- Prescribe header end-->
        <div class="prescribe-review">
            <div class="problem-area">
                <h3>সমস্যা : </h3>
                <ul class="problem-list">
                   <?php
                        $prbResult = $db->query("SELECT * FROM allproblem WHERE pid = '$getfid'");
                        while($prbrow = $prbResult->fetch_array(MYSQLI_ASSOC)){
                            if($prbrow['icon'] == 1){
                                echo '<li><img src="assets/img/rx.png" alt=""> <span>'.$prbrow['problem'].'</span></li>';
                            }else{
                                echo '<li><img src="assets/img/delta.png" alt=""> <span>'.$prbrow['problem'].'</span></li>';
                            }
                        }
                        gettheproblem($getpid);
                    ?>
                    <span>
                        <a href="" class="visible" data-toggle="modal" data-target="#exampleModalLong1"><i class="fa fa-plus"></i></a>
                    </span>
                </ul>
            </div>
            <div class="prescribe">
                <ul class="pres">
                    <?php 
                        getTheMedecine($getfid);
                        getTheInsertMedecine($getpid);
                    ?>
                    <strong><a href="" class="visibles" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus"></i></a>Add</strong>
                    
                </ul>
            </div>
        </div>
    </div>
<!--Prescribe Preview area start-->
    <div class="preview-area">
        <div class="pre-head">
            <div class="col-md-3">
                <span>ID: <?php echo substr($row['fevername'],0,3).$getpid;?></span>
            </div>
            <div class="col-md-4">
                <span>Name: <?php echo $row['pname'];?></span>
            </div>
            <div class="col-md-2">
                <span class="text-right"><?php echo $row['age'];?> Yrs</span>
            </div>
            <div class="col-md-3">
                <span class="text-right"><?php echo substr($row['times'],0,10);?></span>
            </div>
        </div>
        <div class="pres-preview">
            <div class="problem-area">
                <h3>সমস্যা : </h3>
                <ul class="problem-list">
                    <?php
                    $prbResult = $db->query("SELECT * FROM allproblem WHERE pid = '$getfid'");
                        while($prbrow = $prbResult->fetch_array(MYSQLI_ASSOC)){
                            if($prbrow['icon'] == 1){
                                echo '<li><img src="assets/img/rx.png" alt=""> <span>'.$prbrow['problem'].'</span></li>';
                            }else{
                                echo '<li><img src="assets/img/delta.png" alt=""> <span>'.$prbrow['problem'].'</span></li>';
                            }
                        }
                        gettheproblem($getpid);
                    ?>
                </ul>
            </div>
            <div class="prescribe">
                <ul class="pres">
                    <?php 
                        getTheMedecine($getfid);  
                        getTheInsertMedecine($getpid);
                    ?>
                </ul>
                <button type="button" class="visible" data-toggle="modal" data-target="#exampleModalLong3">print</button>
            </div>
        </div>
    </div>
    <!--Prescribe Preview area start-->
</section>
<!--Prescribe area end-->


<!--print Modal area start-->
<div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="print-area">
                    <div class="preview-area">
                        <span class="p-id">ID: <?php echo substr($row['fevername'],0,3).$getpid;?></span>
                        <div class="pre-head">
                            <div class="row">
                                <div class="text-shift-left">
                                    <span class="p-name">Name: <?php echo $row['pname'];?></span>
                                </div>
                                <div class="text-shift-right">
                                    <span class="p-yer">Yrs: <?php echo $row['age'];?> Yrs</span>
                                    <span class="p-date">Date: <?php echo substr($row['times'],0,10);?></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="print-content">
                            <div class="print-problem-area pull-left"  style="width:29%">
                                <h3>সমস্যা : </h3>
                                <ul class="problem-list">
                                    <?php
                                        $prbResult = $db->query("SELECT * FROM allproblem WHERE pid = '$getfid'");
                                        while($prbrow = $prbResult->fetch_array(MYSQLI_ASSOC)){
                                            if($prbrow['icon'] == 1){
                                                echo '<li><img src="assets/img/rx.png" alt=""> <span>'.$prbrow['problem'].'</span></li>';
                                            }else{
                                                echo '<li><img src="assets/img/delta.png" alt=""> <span>'.$prbrow['problem'].'</span></li>';
                                            }
                                        }
                                        gettheproblem($getpid);
                                    ?>
                                </ul>
                            </div>
                            <div class="print-prescribe pull-right" style="width:70%">
                                <ul class="pres">
                                    <?php 
                                        getTheMedecine($getfid);
                                        getTheInsertMedecine($getpid);
                                    ?>
                                </ul>
                                <button class="btn text-center text-uppercase bg-warning"  onclick="myFunction()" id="print-btn">print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--print  Modal area end-->


<!--Problem Modal area start-->
<div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-plus"></i> Add Illness </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-form custom-body">
                    <form action="" method="POST">
                        <input type="hidden" name="patintid" value="<?php echo $getpid;?>">
                        <label for="icon"><img src="assets/img/delta.png" alt="" style="width:30px; height:30px">
                            <input type="radio" name="icon" id="icon" value="1">
                        </label>
                        
                        <label for="icon2"><img src="assets/img/rx.png" alt="" style="width:30px; height:30px">
                            <input type="radio" name="icon" id="icon2" value="2">
                        </label> 
                        <input type="text" name="problem" id="problem" placeholder="Problem" class="form-control">  
                        <button class="btn btn-primary btn-sm" name="pbl-btn" type="submit">Add Problem</button> 
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <p class="bg-danger text-center">All * mark shuld be fill up ! </p>
            </div>
        </div>
    </div>
</div>
<!--Problem  Modal area end-->

<!--Medecine Search Modal area start-->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p id="ins-msg" class="text-center text-success" ></p>
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-plus"></i> Add Illness </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-form custom-body">
                    <form action="" method="POST">
                        <div class="times">
                           <input type="hidden" name="pid" id="pid" value="<?php echo $getpid;?>">
                            <label for="">Time: </label>
                            <span>সকাcল </span><input type="checkbox" name="time" class="time" value="সকাcল">
                            <span>দুপুcর </span><input type="checkbox" name="time" class="time" value="দুপুcর">
                            <span>রাcত </span><input type="checkbox" name="time" class="time" value="রাcত">
                            <input type="text" name="day" id="day" placeholder="Day" class="form-control">
                            <select name="orderselect" id="orderselect" class="select-order">
                                <option value="">Choose the order</option>
                                <option value=" অল্প পানিতে মাথা ও শরীর ভিজিয়ে নিন । দেঢ় থেকে দু’ চামচ শ্যাম্পু নিয়ে মাথায় দিয়ে ভালোভাবে ফেনা তৈরী করুন । ৫ মিনিট অপেক্ষা করে ভাল ভাবে ধুয়ে গোসল করুন ।  "> অল্প পানিতে মাথা ও শরীর ভিজিয়ে নিন । দেঢ় থেকে দু’ চামচ শ্যাম্পু নিয়ে মাথায় দিয়ে ভালোভাবে ফেনা তৈরী করুন । ৫ মিনিট অপেক্ষা করে ভাল ভাবে ধুয়ে গোসল করুন ।  </option>
                                <option value="নির্দেশমত গোসলের পর সারাগায়ে পর পর ২ দিন মালিশ করবেন । (৭দিন পরে পুনরায় মালিশ করবেন)">নির্দেশমত গোসলের পর সারাগায়ে পর পর ২ দিন মালিশ করবেন । (৭দিন পরে পুনরায় মালিশ করবেন)</option>
                                <option value="শুক্রবার সকালে নাস্তার পর রাতে খাবারের পর ও শনিবার সকালে নাস্তার পর ১টি করে বড়ি খাবেন">শুক্রবার সকালে নাস্তার পর রাতে খাবারের পর ও শনিবার সকালে নাস্তার পর ১টি করে বড়ি খাবেন</option>
                                <option value="নির্দেশমত সাবান ও হালকা কুসুম গরম পানি দিয়ে মুখমন্ডল পরিস্কার করুন ">নির্দেশমত সাবান ও হালকা কুসুম গরম পানি দিয়ে মুখমন্ডল পরিস্কার করুন </option>
                                <option value="শনিবার,রবিবার  সোমবার রাতে খাওয়ার পূর্বে ১টি করে বড়ি খাবেন">শনিবার,রবিবার  সোমবার রাতে খাওয়ার পূর্বে ১টি করে বড়ি খাবেন</option>
                                <option value="২সি.সি ডেটল পানির সাথে মিশিয়ে ল্যেম্প গভীর অংশে পেশিতে নিতে হবে">২সি.সি ডেটল পানির সাথে মিশিয়ে ল্যেম্প গভীর অংশে পেশিতে নিতে হবে</option>
                                <option value="মিলনের ২ ঘন্টা পূর্বে ১টি করে বড়ি খাবেন">মিলনের ২ ঘন্টা পূর্বে ১টি করে বড়ি খাবেন</option>
                                <option value="নির্দেশমত ২১ দিন পর পর ১টি ক্যাপসুল গভীর মাসুল পেশিতে নিবেন">নির্দেশমত ২১ দিন পর পর ১টি ক্যাপসুল গভীর মাসুল পেশিতে নিবেন</option>
                                <option value="নির্দেশমত বড়ি খাওয়ার পূর্বে/পরে খাবেন">নির্দেশমত বড়ি খাওয়ার পূর্বে/পরে খাবেন</option>
                            </select>
                        </div>
                        
                        <input type="text" name="msearch" id="msearch" placeholder="Medecine Search" class="form-control-customize">
                        <button class="btn btn-xs btn-primary" type="button" id="ins-btn"><i class="fa fa-plus"></i>Add</button>
                        
                    </form>
                    <div class="show-medecine">
                        <ul class="show-me" id="inserts">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <p class="bg-danger text-center">All * mark shuld be fill up ! </p>
            </div>
        </div>
    </div>
</div>
<!--Medecine Search Modal area end-->

<?php include('footer.php');?>

<!--Medecine Search by using Ajax -->
<script>
$(document).ready(function(){
    $('#msearch').keyup(function(){
        var medecinename = $('#msearch').val();
        if(medecinename!=''){
                $.ajax({
                    url: 'admin/functions.php',
                    method:'POST',
                    data:{medecinename:medecinename},
                    success:function(data){
                        $('.show-me').html(data);
                    }
                });
           } else{
               $('.show-me').html('<p class="bg-danger">no medecine found</p>');
           }
    });
    
    // Insert Medecine using Ajax by modal
    $('#ins-btn').click(function(){
        var time = getValueUsingClass();
        var patintid = $('#pid').val();
        var day = $('#day').val();
        var orders = $('#orderselect').val();
        var msearch = $('#msearch').val();
        if(patintid !=''){
            $.ajax({
                url:'admin/functions.php',
                method:'POST',
                data:{patintid : patintid , time : time , day : day , orders : orders , msearch : msearch},
                success:function(data){
                    $('#ins-msg').html(data);
                }
            });
        }
        
        
    });
    
    // get checkbox value in jquery custom function
    function getValueUsingClass(){

        var chkArray = [];

        $(".time:checked").each(function() {
            chkArray.push($(this).val());
        });


        var selected;
        selected = chkArray.join('-') ;


        if(selected.length > 0){
            return selected;	
        }else{
            alert("Please at least check one of the checkbox");	
        }
    }
    
});
</script>

<!--Click Li and get value in input search medecine Code -->
<script>
    $(document).on('click', '#inserts li', function(){  
        $('#msearch').val($(this).text());
        $('.show-me ').html('');  
    });
</script>


<script>
    function myFunction() {
        window.print();
    }
    
    $('li').click(function(){
        $(this).hide();
    });
    
</script>