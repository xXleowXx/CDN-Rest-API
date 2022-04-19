<?php
//Inform browser that the output is json and it needs a post request.
header('Content-Type: application/json');
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST"); // here is define the request method

//Load config file
$c = include('config.php');

//Get the data into readable format
$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format

$file = $_FILE['file']['name'];
$tmp_file = $_FILE['file']['tmp_name'];
$file_size = $_FILE['file']['size'];
$token = $_POST['token'];

$path = "./../";

//Generate random name under which we will save file later on.
$random = random_bytes(ceil(64 / 2));
$random_file_location = substr(bin2hex($random), 0, 64);


if(empty($file)) {
	//ERROR HANDLING
    $data = array("get_status"=>"failure", "token_provided"=>$token, "file_name"=> $file, "error_code"=>"file_not_present", "error_details"=>"You have not uploaded any file.");
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT);
    die();
}

if(file_exists($path . $random_file_location)){
  //Regenerate
  $random = random_bytes(ceil(64 / 2));
  $random_file_location = substr(bin2hex($random), 0, 64);
}

move_uploaded_file($tmp_file,$file,$random_file_location);

$conn = new mysqli($c['server_address'], $c['username'], $c['password'], $c['db_name']);

if ($conn->connect_error) {
    $data = array("get_status"=>"failure", "token_provided"=>$token, "file_name"=> $file, "error_code"=>"mysql_failure", "error_details"=>$conn->connect_error);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT);
    die();
}

if ($result = $conn -> query("SELECT * FROM `access` WHERE token = '". $token ."'")) {


  $db_output = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $id = $db_output['id'];

  $result -> free_result();

  //ERROR HANDLING
} else {
    $data = array("get_status"=>"failure", "token_provided"=>$token,"file_name"=> $file, "error_code"=>"query_failed", "error_details" => "MYSQL on our side could not fetch query from the database. Contact the admin.");
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT);
    $conn->close();
    die();
}


if ($result = $conn -> query("INSERT INTO `file_db`(`owner_id`, `file_name`, `file_name_system`) VALUES ('1','file.zip','randomhashadasdasa')")) {
  $result -> free_result();
  $conn->close();
  die();

  //ERROR HANDLING
} else {
    $data = array("get_status"=>"failure", "token_provided"=>$token,"file_name"=> $file, "error_code"=>"query_failed", "error_details" => "MYSQL on our side could not fetch query from the database. Contact the admin.");
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT);
    $conn->close();
    die();
}




?>