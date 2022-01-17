<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_motor', 'Data_motor');
$app->post('/Input_motor', 'Input_motor');
$app->post('/Get_motor_Edit', 'Get_motor_Edit');
$app->post('/Edit_motor', 'Edit_motor');
$app->post('/Delete_motor', 'Delete_motor');
$app->run();

//request semua data yang berada pada tabel motor
function Data_motor($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_motor = '';
        $db = getDB();
        $sql = "SELECT * FROM motor order by id_motor desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_motor = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_motor)
            echo '{"Data_motor": ' . json_encode($Data_motor) . '}';
        else
            echo '{"Data_motor": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data motor untuk selanjutnya akan di simpan di tabel motor
function Input_motor($request, $response)
{

    $data = $request->getParsedBody();
    $nama_motor = $data['nama_motor'];
    $lokasi = $data['lokasi'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO motor(nama_motor, lokasi, harga) VALUES(:nama_motor ,:lokasi, :harga)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_motor", $nama_motor, PDO::PARAM_STR);
        $stmt->bindParam("lokasi", $lokasi, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_motor": "input success"}';
        else
            echo '{"Input_motor": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel motor berdasarkan id_motor
function Get_motor_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_motor = $data['id_motor'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_motor_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM motor WHERE id_motor=:id_motor";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_motor", $id_motor, PDO::PARAM_STR);
        $stmt->execute();
        $Get_motor_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_motor_Edit)
            echo '{"Get_motor_Edit": ' . json_encode($Get_motor_Edit) . '}';
        else
            echo '{"Get_motor_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data motor ubah data berdasarkan id_motor
function Edit_motor($request, $response)
{
    $data = $request->getParsedBody();
    $id_motor = $data['id_motor'];
    $nama_motor = $data['nama_motor'];
    $lokasi = $data['lokasi'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE motor SET nama_motor=:nama_motor, lokasi=:lokasi, harga=:harga WHERE id_motor=:id_motor";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_motor", $id_motor, PDO::PARAM_STR);
        $stmt->bindParam("nama_motor", $nama_motor, PDO::PARAM_STR);
        $stmt->bindParam("lokasi", $lokasi, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_motor": "Edit success"}';
        else
            echo '{"Edit_motor": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data motor berdasarkan id_motor
function Delete_motor($request, $response)
{
    $data = $request->getParsedBody();
    $id_motor = $data['id_motor'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM motor WHERE id_motor=:id_motor";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_motor", $id_motor, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_motor": "Delete success"}';
        else
            echo '{"Delete_motor": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}