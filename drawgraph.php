<?php
require_once("library.php");
require_once("jpgraph/jpgraph.php");
require_once ('jpgraph/jpgraph_scatter.php');

# get selected file
$file = isset($_GET['file']) ? $_GET['file'] : false;
$path = "csvfiles/";
$types = isset($_GET['types']) ? explode(",",$_GET['types']) : false;
# read file into array
$data = array();
if ( $file && FromCSV($path.$file, $data) ) {
    $graph = new Graph(300,200);
    $graph->SetScale("linlin");

    $graph->img->SetMargin(40,40,40,40);        
    $graph->SetShadow();

    $graph->title->Set("A simple scatter plot");
    $graph->title->SetFont(FF_FONT1,FS_BOLD);

#die(print_r($types,1));
    foreach ( $data as $type=>$series) {
        $datax = $data[$type]['x'];
        $datay = $data[$type]['y'];
        if ( (is_array($types) && in_array($type, $types) ) || ! $types ){
            $sp1 = new ScatterPlot($datay,$datax);
            $graph->Add($sp1);
        }
    }// we have data:

    $graph->Stroke();
}


