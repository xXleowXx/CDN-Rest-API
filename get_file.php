<?php

//Get the request method from the $_SERVER

//Print the request method out on to the page.
$file_name = $_GET['file'];
$access_token = '082DB07B60D5A99F8CEBEF3F12A2E13A'


// if token exists in database
// check is file coorelated with database


if ($dummy_mysql_response){
    $access_granted = true;
}



// Suppose your "public_html" folder is .
$file = './../$file_name';
$userCanDownloadThisFile = true; // apply your logic here


if (file_exists($file) && $userCanDownloadThisFile) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=filename.gif');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);

}



?>