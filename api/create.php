<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/adresses.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Adresse($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->adress = $data->adress;
    $item->latitude = $data->latitude;
    $item->longitude = $data->longitude;
    
    if($item->createAdresse()){
        echo 'adresse created successfully.';
    } else{
        echo 'adresse could not be created.';
    }
?>