<?php
include('../db.php');
//
////Delete illness Name (Apps) Code
if(isset($_GET['appsid'])){
    $deleteid = $_GET['appsid'];
    $deletesql = "DELETE FROM fevername WHERE id = '".$deleteid."'";
    $appsdeleteresult = mysqli_query($db,$deletesql);
    if($appsdeleteresult){
        header('location:illness.php');
    }
    else{
        echo 'no';
    }
}
//
//// Delete Code Medecine in medecine page modal
//
if(isset($_GET['medecinedeleteid'])){
    $medecineDeleteSql = "DELETE FROM medecine WHERE id = '".$_GET['medecinedeleteid']."'";
    $medecineDeleteResult = mysqli_query($db, $medecineDeleteSql);
    if($medecineDeleteResult){
        header('location: medecine.php');
    } else{
        echo '(: (: Something is missing !';
    }
}
//
//// Insert Code Medecine Add in medecine page modal
//
if(isset($_POST['addname'])){
    $medeid = "SELECT MAX(id) as mid FROM medecine";
    $medeResult = mysqli_query($db , $medeid);
    $medeidRow = mysqli_fetch_array($medeResult);
    $idcount = $medeidRow['mid'] + 1;
    
    if(empty($_POST['addname']) || empty($_POST['addcategory'])){
        echo '(: (: Something is missing !';
    } else{
        $addmedecine = "INSERT INTO medecine VALUES('".$idcount."','".$_POST['addname']."','".$_POST['addcategory']."','all')";
        $addmedecineResult = mysqli_query($db , $addmedecine);
        if($addmedecineResult){
            echo ':) :) Add Successfully Completed !';
        } else{
            echo '(: (: Something is missing !';
        }
    }
}
//
//// Search Code Medecine Search in profile page modal
//
if(isset($_POST['medecinename'])){
    $output = '';
    $searchMedecineSql = "SELECT * FROM medecine WHERE name LIKE '%".$_POST['medecinename']."%' ORDER BY category";
    $searchMedecineResult = $db->query($searchMedecineSql);
    while($searchMedecineRow = $searchMedecineResult->fetch_array(MYSQLI_ASSOC)){
        $output.='
            <li>'.$searchMedecineRow['name'].'</li>
        ';
    }
    echo $output;
    
}
//
//// Search Code Medecine Search in Medecine page
//
if(isset($_POST['medecinenames'])){
    $output = '';
    $searchMedecineSql = "SELECT * FROM medecine WHERE name LIKE '%".$_POST['medecinenames']."%' ORDER BY category";
    $searchMedecineResult = mysqli_query($db,$searchMedecineSql);
    $idcount = 1;
    while($searchMedecineRow = mysqli_fetch_array($searchMedecineResult)){
        $output.='
            <tr>
                <td>'.$idcount++.'</td>
                <td>'.$searchMedecineRow['category'].'</td>
                <td>'.$searchMedecineRow['name'].'</td>
                <td>
                    <a href="editmedecine.php ? editmedecineid='.$searchMedecineRow['id'].'" class="btn btn-primary btn-xs" data-toggle="modal"><i class="fa fa-pencil-square-o"></i>Edit</a>
                    <input type="hidden" name="deleteid" id="deleteid" value="">
                    <a href="functions.php ? medecinedeleteid='.$searchMedecineRow['id'].'" id="medecine-delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
                </td>
            </tr>
        ';
    }
    echo $output;

}
//
//// Update code for Problem ,photo from editpbl.php
if(isset($_POST['pblname'])){
    $pblname = $_POST['pblname'];
    $pblimg = $_POST['pblicon'];
    $pid = $_POST['pid'];
    $output ='';

    if($pblname =='' && $pblimg ==''){
        $output.= '(: (: Something is missing !';
    }
    else{
        $updatesql = "UPDATE allproblem set problem='".$pblname."' , icon = '".$pblimg."' WHERE id = '".$pid."'";
        $updateresult = mysqli_query($db, $updatesql);
        if($updateresult){
            $output.= ':) :) Update Successfully Completed !';
        }
    }
    echo $output;
}
//
//// delete code for Problem delete for profile.php page
//if(isset($_GET['del'])){
//    $deleteid = $_GET['del'];
//    $mid = $_GET['patientid'];
//    $name = $_GET['name'];
//    $delpbl = "DELETE FROM pblpatient WHERE id='".$deleteid."'";
//    $delpblresult = mysqli_query($db, $delpbl);
//    if($delpblresult){
//        $location = 'location:../profile.php ?patientid='.$mid.'&name='.$name;
//        header($location);
//    }
//}
//
//// delete code for Medecine delete for illeditmedecine.php page
if(isset($_GET['delme'])){
    $deleteid = $_GET['delme'];
    $illid = $_GET['illid'];
    $delpbl = "DELETE FROM allmedecine WHERE id='".$deleteid."'";
    $delpblresult = mysqli_query($db, $delpbl);
    if($delpblresult){
        $location = 'location:illeditmedecine.php ?illid='.$illid;
        header($location);
    }
}

//Medecine insert in profile.php page by using ajax in modal form
if(isset($_POST['patintid'])){
    $patintid = $_POST['patintid'];
    $time = $_POST['time'];
    $day = $_POST['day'];
    $orders = $_POST['orders'];
    $msearch = $_POST['msearch'];
    
    if(empty($patintid) || empty($time) || empty($day) || empty($orders) || empty($msearch)){
        echo 'Something is Missing';
    } else{
        $checksql = "SELECT * FROM prescribe WHERE pid ='".$patintid."' && medecine='".$msearch."'";
        $checkResult = $db->query($checksql);
        $checkRow = $checkResult->num_rows;
        if($checkRow >=1){
            echo 'Medecine Already Exiest !';
        } else{
            $minsert = "INSERT INTO `prescribe`(`pid`, `medecine`, `days`, `time`, `orders`)                  VALUES('".$patintid."','".$msearch."','".$day."','".$time."','".$orders."')";
            $mResult = $db->query($minsert);
            if($mResult){
                echo 'Insert Successfully Completed';
            }else{
                echo 'Wrong Process';
            }
        }
    }
}

// Delete Medecine from prescribe table in profile page

if(isset($_GET['bid'])){
    $bid = $_GET['bid'];
    $fid = $_GET['fid'];
    $pid = $_GET['pid'];
    $result = $db->query("DELETE FROM prescribe WHERE id = '$bid'");
    if($result){
        $location = 'location:../profile.php?fid='.$fid.'&pid='.$pid;
        header($location);
    }
}
// Delete Medecine from prescribe table in editpatient page

if(isset($_GET['ebid'])){
    $bid = $_GET['ebid'];
    $fid = $_GET['fid'];
    $pid = $_GET['pid'];
    $result = $db->query("DELETE FROM prescribe WHERE id = '$bid'");
    if($result){
        $location = 'location:editpatient.php?fid='.$fid.'&pid='.$pid;
        header($location);
    }
}


// Search patint from any table by using searchid from addpatint.php page
//
if(isset($_POST['searchid']) && isset($_POST['fid'])){
    $searchid = $_POST['searchid'];
    $fid = $_POST['fid'];
    $output ='';
    
    $srcsql = "SELECT patient.name as name, patient.age as age, patient.datetimes as date FROM patient right join fevername on patient.fid = fevername.id WHERE patient.id='".$searchid."' AND patient.fid='$fid'";
    $srcresult = $db->query($srcsql);
    $srcrows = $srcresult->num_rows;
    if($srcrows <= 0){
        $output .='<p class="alert alert-danger text-center">Have no Patient !</p>';
    }else{
        $srcrow = $srcresult->fetch_array(MYSQLI_ASSOC);
        echo '
            <tr>
                <td>'.$srcrow['name'].'</td>
                <td>'.$srcrow['age'].'</td>
                <td>'.$srcrow['date'].'</td>
                <td><a href="editpatient.php?fid='.$fid.'&pid='.$searchid.'">view</a></td>
            </tr>';
    }
    echo $output;
    }
//    
////Medecine Delete from editpatient Odrpatint table
//if(isset($_GET['mdel']) && isset($_GET['uid']) && isset($_GET['pid']) && isset($_GET['illname'])){
//    $mdel = $_GET['mdel'];
//    $uid = $_GET['uid'];
//    $pid = $_GET['pid'];
//    $illname = $_GET['illname'];
//    
//    $delsql = "DELETE FROM odrpatint WHERE uid='".$uid."' && id='".$mdel."'";
//    $delresult = mysqli_query($db,$delsql);
//    if($delresult){
//        $location = 'location:editpatient.php?pid='.$pid.'&illname='.$illname;
//        header($location);
//    }
//}
////Problem Delete from editpatient pblpatint table
//if(isset($_GET['pdel']) && isset($_GET['uid']) && isset($_GET['pid']) && isset($_GET['illname'])){
//    $pdel = $_GET['pdel'];
//    $uid = $_GET['uid'];
//    $pid = $_GET['pid'];
//    $illname = $_GET['illname'];
//    
//    $delsql = "DELETE FROM pblpatient WHERE userid='".$uid."' && id='".$pdel."'";
//    $delresult = mysqli_query($db,$delsql);
//    if($delresult){
//        $location = 'location:editpatient.php?pid='.$pid.'&illname='.$illname;
//        header($location);
//    }
//}
//
////Update pname and age in editpatient.php page by using Ajax
//
if(isset($_POST['puname']) && isset($_POST['pid']) && isset($_POST['yrs'])){
    $pname = $_POST['puname'];
    $pid = $_POST['pid'];
    $yrs = $_POST['yrs'];
    $pusql = "UPDATE patient SET name='".$pname."', age='".$yrs."' WHERE id='".$pid."'";
    $puresult = $db->query($pusql);
    if($puresult){
        echo 'Success';
    } else{
        echo 'Not';
    }
}
//if(isset($_POST['page']) && isset($_POST['pid']) && isset($_POST['illid'])){
//    $page = $_POST['page'];
//    $pid = $_POST['pid'];
//    $illid = $_POST['illid'];
//    if($illid == 1){
//        $tablename = 'chrpatint'; 
//    } elseif($illid == 2){
//        $tablename = 'dhapatint'; 
//    } elseif($illid == 3){
//        $tablename = 'alopatint';  
//    } elseif($illid == 4){
//        $tablename = 'avpatint'; 
//    } elseif($illid == 5){
//        $tablename = 'edepatint';  
//    } elseif($illid == 6){
//        $tablename = 'dhpatint'; 
//    } elseif($illid == 7){
//        $tablename = 'tinpatint'; 
//    } elseif($illid == 8){
//        $tablename = 'melpatint'; 
//    } elseif($illid == 9){
//        $tablename = 'sebpatint'; 
//    } elseif($illid == 10){
//        $tablename = 'derpatint';    
//    } elseif($illid == 11){
//        $tablename = 'herpatint';    
//    } elseif($illid == 12){
//        $tablename = 'barpatint';    
//    } elseif($illid == 13){
//        $tablename = 'lotpatint';    
//    } elseif($illid == 14){
//        $tablename = 'sprpatint';   
//    } elseif($illid == 15){
//        $tablename = 'injpatint';  
//    }
//    $pusql = "UPDATE $tablename SET age='".$page."' WHERE mid='".$pid."'";
//    $puresult = mysqli_query($db,$pusql);
//    if($puresult){
//        echo 'Success';
//    } else{
//        echo 'Not';
//    }
//}



