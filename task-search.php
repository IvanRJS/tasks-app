<?php
include('database.php');

$search = $_POST['search'];


if(!empty($search)){
    //query searching the given value 
    $query = "select * from task where name like '$search%'";
    //SELECT * FROM `task` where name like 'write%'
    $result = mysqli_query($conn,$query);
    //if there is some error ends the proccess
    if(!$result){
        die('Query error'.mysqli_error($conn));
    }
    //fetching the result as an array
    $json = array();
    while ($row=mysqli_fetch_array($result)) {
        $json [] = array(
        //converting array into a Json type variable 
            'name'=> $row['name'],
            'description'=> $row['description'],
            'id'=> $row['id'],
        );
    }
    //encoding the variable into JSON and returning its value
    $jsonstring = json_encode($json);
    echo $jsonstring;

}

?>