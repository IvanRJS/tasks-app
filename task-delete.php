<?php
include('database.php');

if(isset($_POST['id'])){

    $id=$_POST['id'];
    $query="delete from task where id= $id";
    
    $result=mysqli_query($conn,$query);
    if(!$result){
        die('Query failed.');
    }
    echo "Task deleted successfully";
}

?>