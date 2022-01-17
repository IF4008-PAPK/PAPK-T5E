<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_warnet', 'Data_warnet');
$app->post('/Input_warnet', 'Input_warnet');
$app->post('/Get_warnet_Edit', 'Get_warnet_Edit');
$app->post('/Edit_warnet', 'Edit_warnet');
$app->post('/Delete_warnet', 'Delete_warnet');
$app->run();

//request semua data yang berada pada tabel warnet
function Data_warnet($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_warnet = '';
        $db = getDB();
        $sql = "SELECT * FROM warnet order by id_warnet desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_warnet = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_warnet)
            echo '{"Data_warnet": ' . json_encode($Data_warnet) . '}';
        else
            echo '{"Data_warnet": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data warnet untuk selanjutnya akan di simpan di tabel warnet
function Input_warnet($request, $response)
{

    $data = $request->getParsedBody();
    $nama_member = $data['nama_member'];
    $billing = $data['billing'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO warnet(nama_member, billing, harga) VALUES(:nama_member ,:billing, :harga)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_member", $nama_member, PDO::PARAM_STR);
        $stmt->bindParam("billing", $billing, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_warnet": "input success"}';
        else
            echo '{"Input_warnet": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel warnet berdasarkan id_warnet
function Get_warnet_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_warnet = $data['id_warnet'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_warnet_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM warnet WHERE id_warnet=:id_warnet";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_warnet", $id_warnet, PDO::PARAM_STR);
        $stmt->execute();
        $Get_warnet_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_warnet_Edit)
            echo '{"Get_warnet_Edit": ' . json_encode($Get_warnet_Edit) . '}';
        else
            echo '{"Get_warnet_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data warnet ubah data berdasarkan id_warnet
function Edit_warnet($request, $response)
{
    $data = $request->getParsedBody();
    $id_warnet = $data['id_warnet'];
    $nama_member = $data['nama_member'];
    $billing = $data['billing'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE warnet SET nama_member=:nama_member, billing=:billing, harga=:harga WHERE id_warnet=:id_warnet";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_warnet", $id_warnet, PDO::PARAM_STR);
        $stmt->bindParam("nama_member", $nama_member, PDO::PARAM_STR);
        $stmt->bindParam("billing", $billing, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_member": "Edit success"}';
        else
            echo '{"Edit_member": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data member berdasarkan id_member
function Delete_warnet($request, $response)
{
    $data = $request->getParsedBody();
    $id_warnet = $data['id_warnet'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM warnet WHERE id_warnet=:id_warnet";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_warnet", $id_warnet, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_warnet": "Delete success"}';
        else
            echo '{"Delete_warnet": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}