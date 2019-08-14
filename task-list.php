<?php
include('conexion.php');
$json = array();

$con = new conexion();
$objCon=$con->conectar();

$query="SELECT * FROM task";
$result=$objCon->prepare($query);
$result->execute();
           

if(!$result){
    die('Query failed').mysqli_error($con);
}

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