<?php
include_once('database.php');
$json = array();

$objCon = new conexion();
$con=$objCon->conectar();

$query="select * from task";
$con->prepare($query);
$result=$con->execute($query);
           

if(!$result){
     // die('Query failed').mysqli_error($con);
      $json [] = array(
        'name' => 'fail',
        'description' => 'fail',
        'id' => '1',
    );
    $jsonstring = Json_encode($json);
    echo $jsonstring;
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