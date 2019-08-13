<?php
include('database.php');

if(isset($_POST['id'])){

$name = $_POST['name'];
$description = $_POST['description'];
$id = $_POST['id'];


$query="update task set name = '$name' , description = '$description' where id =  $id";

$result = mysqli_query($conn, $query);
if(!$result){
    die('Query failed.');

}
echo "Task successfully updated.";

}



?>