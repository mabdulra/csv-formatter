<?php

//  This is called over AJAX, all `echo` statements will be returned to the caller
//  We do not need to include UTF-8 information here because of that, the caller has the encoding
//  While we can check mimetype and filetype, it is untrustworthy for CSV files due to large variety
//  We will instead keep track of number of rows as we go through the print loop
require_once("errors.php");

//  This has to be personally configured, by default headers are enabled
const HEADERS_ENABLED = true;
$headersOutstanding = true;
$tableOutstanding   = true;

//  Does $_FILES have the `csvFile` key?
if( !array_key_exists('csvFile',$_FILES) )
    throwError(ERR_NOCSVFILE);

//  Attempt to open tmp_name file
if( ($fp=fopen($_FILES['csvFile']['tmp_name'],'r'))===false )
    throwError(ERR_FOPEN);

//  Read rows of the CSV
$count  = 0;
$rowodd = true;
while( ($row=fgetcsv($fp))!==false )
{
    //  Did we somehow end up with a 0-element row?
    if( count($row)==0 )
        throwError(ERR_EMPTYARRAY);
    
    //  Set alternating class styles for row
    if( $rowodd )
        $class = 'rowodd';
    else
        $class = 'roweven';
    
    //  At start of processing, open the table
    if( $tableOutstanding )
    {
        echo "<table>";
    }
    //  If there is a row count mismatch from the first row, header or otherwise, throw an error
    else if( count($row)!=$count )
    {
        echo "</table>";
        throwError(ERR_ROWMISMATCH);
    }

    //  Begin processing print row
    echo "<tr>";
    foreach( $row as $r )
    {
        //  Determine whether to use <th> or <td> based on row settings
        if( $headersOutstanding )
            echo "<th>$r</th>";
        else
            echo "<td class='$class'>$r</td>";
    }
    echo "</tr>";
    $headersOutstanding = false;

    //  If this was our first loop through the table, count how many rows we have
    if( $tableOutstanding )
    {
        $tableOutstanding = false;
        $count = count($row);
    }
    //  Otherwise, flip the odd/even counter
    else
    {
        $rowodd = !$rowodd;
    }
}

//  Did we have a valid table?
if( $tableOutstanding )
    throwError(ERR_NOTABLE);
else
    echo "</table>";

fclose($fp);

?>