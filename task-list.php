<?php
include_once('database.php');

$objCon = new conexion();
$con=$objCon->conectar();

$query="select * from task";
$stm = $objcon->prepare($query);
$result=$objcon->execute($query);
           

//$result=$pdo->prepare($query);
if($result){
    header("location: error.php");
    die('Query failed').mysqli_error($con);
}

$json = array();
while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
    $json [] = array(
        'name' => $row['name'],
        'description' => $row['description'],
        'id' => $row['id'],
    );
}
$jsonstring = Json_encode($json);
echo $jsonstring;
?>