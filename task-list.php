<?php
include('database.php');

$query="select * from task";

$result=mysqli_query($conn,$query);

if(!$result){
    die('Query failed').mysqli_error($conn);
}

$json []= array();
while ($row=mysqli_fetch_array($result)) {
    $json [] = array(
        'name' => $row['name'],
        'description' => $row['description'],
        'id' => $row['id'],
    );
}
$jsonstring = Json_encode($json);
echo $jsonstring;
?>