<?php
/**
 * index.php
 * bespoke, simple app controller
 * 
 */

# common functions
require_once("library.php");

# config
$uploadpath = "csvfiles/";
$uploadpathwritable =  is_writable($uploadpath);

# get selected file
$file = isset($_GET['file']) ? $_GET['file'] : false;

# handle uploads
$msg = "check forms: ";
if ( $uploadpathwritable && isset($_FILES['uploadfile']['name']) ){
#    $msg .= "|got file";
    $file = $_FILES['uploadfile']['name'];
    move_uploaded_file($_FILES['uploadfile']['tmp_name'], 'csvfiles/'.$file);
    header("Location: ?file=$file");
    exit;
}
#echo $msg;

# data for template

# load data file to extract datatypes
$data = array();
if ( $file && FromCSV($uploadpath.$file, $data) ) {
    # datatype list for current file
    $datatypes = array_keys($data);
}

# load list of available files
$fd = opendir($uploadpath);
$availablefiles = array();
while ( $f = readdir($fd)){
    if (substr($f, -4 ) != ".csv") continue;
    $availablefiles[] = $f;
}

# load page template :
include("template.php");


