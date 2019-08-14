<?php
include('conexion.php');

$con= new conexion();
$objCon=$con->conectar();



if(isset($_POST['id'])){

$name = $_POST['name'];
$description = $_POST['description'];
$id = $_POST['id'];


$query="update task set name = :name , description = :description where id =  :id";

$result = $objCon->prepare($query);
$result->bindParam(':name',$name,PDO::PARAM_STR);
$result->bindParam(':description',$description,PDO::PARAM_STR);
$result->bindParam(':id',$id,PDO::PARAM_INT);

$result->execute();


if(!$result){
    die('Query failed.');

}
echo "Query successfully updated.";

}


?>