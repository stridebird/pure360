<?php
require_once("library.php");
require_once("jpgraph/jpgraph.php");
require_once('jpgraph/jpgraph_scatter.php');


# get selected file
$file = isset($_GET['file']) ? $_GET['file'] : false;
$path = "csvfiles/";
$types = isset($_GET['types']) ? explode(",",$_GET['types']) : false;
# read file into array
$data = array();
if ( $file && FromCSV($path.$file, $data) ) {
    $graph = new Graph(600,400);
    foreach ( $data as $type=>$series) {
        $max_x[] = max($data[$type]['x']);
        $max_y[] = max($data[$type]['y']);
    }
    $graph->SetScale("linlin",0,max($max_y),0,max($max_x));

    $graph->img->SetMargin(40,40,40,40);        
    $graph->SetShadow();

    $graph->title->SetColor("red");
    $graph->title->Set($file);

#die(print_r($types,1));
    $c = 0;
    foreach ( $data as $type=>$series) {
        $datax = $data[$type]['x'];
        $datay = $data[$type]['y'];
        $colour = $plotseriescolours[ $c++ % count($plotseriescolours )];
        if ( (is_array($types) && in_array($type, $types) ) || ! $types ){
            $sp1 = new ScatterPlot($datay,$datax);
            $sp1->mark->SetType(MARK_FILLEDCIRCLE);
            $sp1->mark->SetFillColor("$colour");
            $sp1->mark->SetWidth(3);            
            $graph->Add($sp1);
        }
    }// we have data:

    $graph->Stroke();
}


