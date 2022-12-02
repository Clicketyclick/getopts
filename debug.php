<?php


function debug( $str )
{
    global $debug;
    $bt     = debug_backtrace();
    $caller = array_shift($bt);

    if ( $debug ?? false) 
        fprintf( STDERR, "%s[%s]: %s\n", basename($caller['file']), $caller['line'], $str );
}   // debug()


?>