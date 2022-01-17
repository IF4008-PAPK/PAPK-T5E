<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_mobil', 'Data_mobil');
$app->post('/Input_mobil', 'Input_mobil');
$app->post('/Get_mobil_Edit', 'Get_mobil_Edit');
$app->post('/Edit_mobil', 'Edit_mobil');
$app->post('/Delete_mobil', 'Delete_mobil');
$app->run();

//request semua data yang berada pada tabel mobil
function Data_mobil($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_mobil = '';
        $db = getDB();
        $sql = "SELECT * FROM mobil order by id_mobil desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_mobil = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_mobil)
            echo '{"Data_mobil": ' . json_encode($Data_mobil) . '}';
        else
            echo '{"Data_mobil": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data mobil untuk selanjutnya akan di simpan di tabel mobil
function Input_mobil($request, $response)
{

    $data = $request->getParsedBody();
    $nama_mobil = $data['nama_mobil'];
    $jumlah = $data['jumlah'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO mobil(nama_mobil, jumlah, harga) VALUES(:nama_mobil ,:jumlah, :harga)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_mobil", $nama_mobil, PDO::PARAM_STR);
        $stmt->bindParam("jumlah", $jumlah, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_mobil": "input success"}';
        else
            echo '{"Input_mobil": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel mobil berdasarkan id_mobil
function Get_mobil_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_mobil = $data['id_mobil'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_mobil_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM mobil WHERE id_mobil=:id_mobil";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_mobil", $id_mobil, PDO::PARAM_STR);
        $stmt->execute();
        $Get_mobil_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_mobil_Edit)
            echo '{"Get_mobil_Edit": ' . json_encode($Get_mobil_Edit) . '}';
        else
            echo '{"Get_mobil_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data mobil ubah data berdasarkan id_mobil
function Edit_mobil($request, $response)
{
    $data = $request->getParsedBody();
    $id_mobil = $data['id_mobil'];
    $nama_mobil = $data['nama_mobil'];
    $jumlah = $data['jumlah'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE mobil SET nama_mobil=:nama_mobil, jumlah=:jumlah, harga=:harga WHERE id_mobil=:id_mobil";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_mobil", $id_mobil, PDO::PARAM_STR);
        $stmt->bindParam("nama_mobil", $nama_mobil, PDO::PARAM_STR);
        $stmt->bindParam("jumlah", $jumlah, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_mobil": "Edit success"}';
        else
            echo '{"Edit_mobil": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data mobil berdasarkan id_mobil
function Delete_mobil($request, $response)
{
    $data = $request->getParsedBody();
    $id_mobil = $data['id_mobil'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM mobil WHERE id_mobil=:id_mobil";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_mobil", $id_mobil, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_mobil": "Delete success"}';
        else
            echo '{"Delete_mobil": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}