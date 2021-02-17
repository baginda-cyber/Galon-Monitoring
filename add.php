<?php
    include('koneksi.php');

    $sensor = isset($_GET['benda']) ? $_GET['benda'] : null;
 
    $sql = "INSERT INTO tbl_sensor(berat) VALUES ('$sensor')";
 
    $stmt = $PDO->prepare($sql);
 
    $stmt->bindParam('benda', $sensor);
 
    if($stmt->execute()) {
        echo "sukses gaes";
    }else{
        echo "gagal gaes";
    }
?>