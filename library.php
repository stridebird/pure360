<?php

$plotseriescolours = array("red","blue","green","orangered","orchid", "black","yellow");


function FromCSV($aFile,&$aData,$aSepChar=',',$aMaxLineLength=1024) {
    # ripped from jpgraph_utils
    $rh = @fopen($aFile,'r');
    if( $rh === false ) {
            return false;
    }
    $tmp = array();
    $lineofdata = fgetcsv($rh, 1000, ',');
    while ( $lineofdata !== FALSE) {
        $type = array_shift($lineofdata);
        $x = array_shift($lineofdata);
        $y = array_shift($lineofdata);
        if ( $type && is_numeric($x) && is_numeric($y) ) {
            $tmp[$type]['x'][]  = $x;
            $tmp[$type]['y'][]  = $y;
        }
        $lineofdata = fgetcsv($rh, $aMaxLineLength, $aSepChar);
    }
    fclose($rh);
    $aData = $tmp;
    return count($aData);
}
