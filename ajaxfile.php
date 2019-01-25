<?php
include('db.php');
if(isset($_GET['imid'])){
    $id = $_GET['imid'];
    $sql = "SELECT * FROM fevername WHERE id ='".$id."'";
    $result = $db->query($sql);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $imageData = $row['icon'];
        $imageType= $row['icontype'];
    }
    header('content-type: image/"'.$imageType.'"');
    echo $imageData;
}
if(isset($_GET['prbid'])){
    $id = $_GET['prbid'];
    $sql = "SELECT * FROM problems WHERE id ='".$id."'";
    $result = $db->query($sql);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $imageData = $row['icon'];
        $imageType= $row['icontype'];
    }
    header('content-type: image/"'.$imageType.'"');
    echo $imageData;
}