<?php
/**
 * index.php
 * bespoke, simple app controller
 * 
 */

session_start();

# common functions
require_once("library.php");

# configuration:
$uploadpath = "csvfiles/";
$uploadpathwritable =  is_writable($uploadpath);

# get selected file
$file = isset($_GET['file']) ? $_GET['file'] : false;

# handle uploads
if ( $uploadpathwritable && isset($_FILES['uploadfile']['name']) ){
    $file = $_FILES['uploadfile']['name'];
    move_uploaded_file($_FILES['uploadfile']['tmp_name'], 'csvfiles/'.$file);
    $data = array();
    if ( ! FromCSV($uploadpath.$file, $data) ) {
        unlink($uploadpath.$file);
        $_SESSION['messages'][] = "Invalid format $file: removed";
        $file = FALSE;
    }
    header("Location: ?file=$file");
    exit;
}

# load data file to extract datatypes
$data = array();
if ( $file && FromCSV($uploadpath.$file, $data) ) {
    # datatype list for current file
    $datatypes = array_keys($data);
}

# get the list of available files
$fd = opendir($uploadpath);
$availablefiles = array();
while ( $f = readdir($fd)){
    if (substr($f, -4 ) != ".csv") continue;
    $availablefiles[] = $f;
}

# load page template :
include("template.php");


