<?php
include('database.php');

$search = $_POST['search'];


if(!empty($search)){
    //query buscando en la BD el valor digitado por el usuario
    $query = "select * from task where name like '$search%'";
    //SELECT * FROM `task` where name like 'write%'
    $result = mysqli_query($conn,$query);
    //si hay algún error en el query acaba el proceso
    if(!$result){
        die('Query error'.mysqli_error($conn));
    }
    //recorrer el resultado como un array
    $json = array();
    while ($row=mysqli_fetch_array($result)) {
        $json [] = array(
        //convertir el array a una variable 
            'name'=> $row['name'],
            'description'=> $row['description'],
            'id'=> $row['id'],
        );
    }
    //convertir la variable con los datos json
    $jsonstring = json_encode($json);
    echo $jsonstring;

}

?>