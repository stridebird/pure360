<?php
/**
 * index.php
 * bespoke, simple app controller
 * 
 */

require_once("library.php");

# handle uploads
$msg = "check forms: ";
if ( $_POST ){
    $msg .= "|got post";
    if ( $_FILES ){
        $msg .= "|got file";
    }
}
#echo $msg;

# get selected file
$file = isset($_GET['file']) ? $_GET['file'] : false;
$path = "csvfiles/";


$data = array();
if ( $file && FromCSV($path.$file, $data) ) {
    $datatypes = array_keys($data);
}

# data for template
# file list
$fd = opendir($path);
$availablefiles = array();
while ( $f = readdir($fd)){
    if (substr($f, -4 ) != ".csv") continue;
    $availablefiles[] = $f;
}
    
# datatype list for current file

include("template.php");


