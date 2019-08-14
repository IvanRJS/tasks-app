<?php
include('conexion.php');

$search = $_POST['search'];

$con=new conexion();
$objCon= $con->conectar();



if(!empty($search)){
    //query searching the given value 
    $query = "SELECT * FROM task WHERE name LIKE :search";
    //SELECT * FROM `task` where name like 'write%'
    $result = $objCon->prepare($query);
    $result->bindParam(':search',$search."%",PDO::PARAM_STR);
    $result->execute();
    //if there is some error ends the proccess
    if(!$result){
        die('Query error'.mysqli_error($conn));
    }
    //fetching the result as an array
    $json = array();
    while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
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