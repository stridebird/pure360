<?php
function FromCSV($aFile,&$aData,$aSepChar=',',$aMaxLineLength=1024) {
    # ripped from jpgraph_utils
    # consider extending class with this new method?
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
        if ( is_numeric($x) && is_numeric($y) ) {
            $tmp[$type]['x'][]  = $x;
            $tmp[$type]['y'][]  = $y;
        }
#        $tmp[$type] = array($x, $y);
#        $tmp = array_merge($tmp,$lineofdata);
        $lineofdata = fgetcsv($rh, $aMaxLineLength, $aSepChar);
    }
#    die("<pre>".print_r($tmp,1)."</pre>");
    fclose($rh);
    $aData = $tmp;
    return count($aData);
    die("<pre>".print_r($tmp,1)."</pre>");

    // Now make sure that all data is numeric. By default
    // all data is read as strings
    $n = count($tmp);
    $aData = array();
    $cnt=0;
    for($i=0; $i < $n; ++$i) {
        if( $tmp[$i] !== "" ) {
            $aData[$cnt++] = floatval($tmp[$i]);
        }
    }
    return $cnt;
}
