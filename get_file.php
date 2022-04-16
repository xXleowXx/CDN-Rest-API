<?php
$c = include('config.php');

//Create connection to the database
$conn = new mysqli($c['server_address'], $c['username'], $c['password'], $c['db_name']);

//Check if the connection has any errors
if ($conn->connect_error) {
    $data = array("get_status"=>"failure", "token_provided"=>$token, "file_name"=> $file, "error_code"=>"mysql_failure", "error_details"=>$conn->connect_error);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT);
    die();
}



if(!$_POST['token']){
    $data = array("get_status"=>"failure", "token_provided"=>"null", "file" => "not_checked", "error_code"=>"token_not_provided", "error_details" => "Token was not provided in the request");
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT);
    die();
} else {
    //Token variable with bullshit removed

  	echo "\n.....................\n";
    echo $_POST['token'] . "\n";
    echo ".....................\n";

     //Submit querry to database in order to get users with that token and verify it.
    if ($result = $conn -> query("SELECT * FROM `access` WHERE token = '". $_POST['token'] ."'")) {

      //Converting output to array
      $db_output = mysqli_fetch_array($result, MYSQLI_ASSOC);

      //Check if provided token is the same as database token, if empty will reject.
      if($db_output['token'] == $_POST['token']){
        //Set Authentication status as true
        $auth = true;
      //If not authenticated throw the error
      }else{
        $data = array("get_status"=>"failure", "token_provided"=>$_POST['token'],"file_name"=> $_POST['file_name_system'], "error_code"=>"token_invalid", "error_details" => "Provided token does not exist in our database");
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_PRETTY_PRINT);
        $conn->close();
        die();
      }

      // Free result set
      $result -> free_result();
    } else {
        $data = array("get_status"=>"failure", "token_provided"=>$_POST['token'],"file_name"=> $_POST['file_name_system'], "error_code"=>"query_failed", "error_details" => "MYSQL on our side could not fetch query from the database. Contact the admin.");
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_PRETTY_PRINT);
        $conn->close();
        die();
    }


}


//Checking if user has provided file name in GET
if($_POST['file_name_system']){
    //File variable with bullshit removed

    echo "\n.....................\n";
    echo $_POST['file_name_system'] . "\n";
    echo ".....................\n";

    //Continue code after auth is successfull....

    if ($result = $conn -> query("SELECT * FROM access, file_db WHERE access.id = file_db.owner_id AND access.token = '". $_POST['token'] ."' AND file_db.file_name_system = '". $_POST['file_name_system'] ."'")) {

      //Converting output to array
      $db_output = mysqli_fetch_array($result, MYSQLI_ASSOC);

      //Check if provided token is the same as database token, if empty will reject.
      if($db_output['file_name_system'] == $_POST['file_name_system']){
          $file = './../' . $_POST['file_name_system'];
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="test.zip"');
          header('Content-Transfer-Encoding: binary');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          ob_clean();
          flush();
          readfile($file);

      }else{
        $data = array("get_status"=>"failure", "token_provided"=>$_POST['token'],"file_name"=> $_POST['file_name_system'], "error_code"=>"file_does_not_exist", "error_details" => "Provided file does not exist on our server");
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_PRETTY_PRINT);
        $conn->close();
        die();
      }


    } else {
        $data = array("get_status"=>"failure", "token_provided"=>$_POST['token'],"file_name"=> $_POST['file_name_system'], "error_code"=>"query_failed", "error_details" => "MYSQL on our side could not fetch query from the database. Contact the admin.");
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_PRETTY_PRINT);
        $conn->close();
        die();
    }


}else{
    $data = array("get_status"=>"failure", "token_provided"=>$_POST['token'], "file_name"=>"null", "error_code"=>"file_not_provided", "error_details" => "File name was not provided in the request");
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT);
    die();
}

?> 