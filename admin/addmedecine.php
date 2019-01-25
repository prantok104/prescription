<?php 
    include('header.php');
    include('../db.php');


    if(isset($_POST['btn-medecine'])){
        $times = $_POST['Timeable'];
        $time = implode('-', $times);
        $day = $_POST['day'];
        $order = $_POST['orderselect'];
        $illid = $_POST['illid'];
        $msearch = $_POST['msearch'];
        
        if(empty($times) || empty($day) || empty($order) || empty($illid) || empty($msearch)){
            echo "Something is missing";
        } else{
            $checksql = "SELECT * FROM allmedecine WHERE orders = '".$order."' && medecine = '".$msearch."' && illid ='".$illid."'";
            $checkResult = mysqli_query($db,$checksql);
            $checkRow = $checkResult->num_rows;
            if($checkRow == 1){
                echo "Medecine Already Exiest";
            }else{
                $findid = "SELECT MAX(id) as id FROM allmedecine";
                $findidResult = mysqli_query($db, $findid);
                $findidRow = mysqli_fetch_array($findidResult);
                $countid = $findidRow['id']+1;
                
                $insertsql = "INSERT INTO allmedecine VALUES('".$countid."','".$time."','".$day."','".$order."','".$msearch."','".$illid."')";
                $insertResult = mysqli_query($db,$insertsql);
                if($insertResult){
                    echo 'Insert SuccessFully Completed';
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
        <div class="problem-from">
            <form action="" method="POST">
                <div class="times">
                    <label for="">Time: </label>
                    <span>সকাcল </span><input type="checkbox" name="Timeable[]" value="সকাcল">
                    <span>দুপুcর </span><input type="checkbox" name="Timeable[]" value="দুপুcর">
                    <span>রাcত </span><input type="checkbox" name="Timeable[]" value="রাcত">
                    
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
                    
                    <select name="illid" id="illid">
                        <?php
                            $illsql = "SELECT * FROM fevername";
                            $illResult = mysqli_query($db,$illsql);
                            echo '<option value="" selected>Choose the Illnessname</option>';
                            while($illRow = mysqli_fetch_array($illResult)){
                                echo '<option value="'.$illRow['id'].'">'.$illRow['name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                
                <input type="text" name="msearch" id="msearch" placeholder="Medecine Search" class="form-control">
                <button class="btn btn-xs btn-primary" type="submit" name="btn-medecine"><i class="fa fa-plus"></i>Add Medecine</button>
            </form>
            <div class="show-medecine">
                <ul class="show-me inserts" id="inserts">
                    <?php

                    $medecineShow = "SELECT * FROM medecine ORDER BY name DESC";
                    $medecineShowResult = mysqli_query($db, $medecineShow);
                    while($medecineShowRow = mysqli_fetch_array($medecineShowResult)){
                        echo '<li>'.$medecineShowRow['name'].'</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div><!-- Admin area end-->
</section>
<?php include('footer.php');?>


<!--Medecine Search by using Ajax -->
<script>
    $(document).ready(function(){
        $('#msearch').keyup(function(){
            var medecinename = $('#msearch').val();
            if(medecinename!=''){
                $.ajax({
                    url: 'functions.php',
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

    });
</script>
<!--Click Li and get value in input search medecine Code -->
<script>
    $(document).on('click', '#inserts li', function(){  
        $('#msearch').val($(this).text());
        $('.show-me ').html('');  
    });
</script>