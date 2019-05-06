<?php
include('database.php');

echo $_POST['name'];
    if(isset($_POST['name'])){
    $name = $_POST['name'];
    $description= $_POST['description'];
    
    $query = "insert into task (name,description) values ('$name','$description')";

    $result=mysqli_query($conn,$query);
    if(!$result){
        die('Query failed');
    }else{
        echo 'Task added successfully';
    }

}



?>