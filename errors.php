<?php

//  Constant definitions for errors
const ERR_NOCSVFILE         = 1;
const ERR_FOPEN             = 2;
const ERR_NOTABLE           = 3;
const ERR_ROWMISMATCH       = 4;
const ERR_EMPTYARRAY        = 5;

function throwError($errno)
{
    echo "ERROR $errno: ";
    switch($errno)
    {
        default:
            echo "Unknown error.";
            break;
        case ERR_NOCSVFILE:
            echo "No CSV file was provided.";
            break;
        case ERR_FOPEN:
            echo "Could not open the file for reading.";
            break;
        case ERR_NOTABLE:
            echo "Could not generate a table from the given file.";
            break;
        case ERR_ROWMISMATCH:
            echo "CSV file has row mismatches. Processing terminated.";
            break;
        case ERR_EMPTYARRAY:
            echo "CSV file returned an empty row";
            break;
    }
    
    //  End script execution to prevent further processing
    exit();
}

?>