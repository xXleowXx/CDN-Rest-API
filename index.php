<?php
header('Content-Type: application/json');
//Get the request method from the $_SERVER
//Print the request method out on to the page.

//Checking if user has provided token in GET
if(!$_GET['token']){
    $data = array("get_status"=>"failure", "token"=>"null", "error_code"=>"token_not_provided");
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT);
    clean_all_processes();
}

//Checking if user has provided file name in GET
if($_GET['file']){
    echo $file_name = $_GET['file'];
}else{
    $data = array("get_status"=>"failure", "file_name"=>"null", "error_code"=>"file_not_provided");
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT);
    clean_all_processes();
}







// if token exists in database
// check is file
?>