<?php
//$debug      = true;

if (php_sapi_name() == "cli") {
    print( "// In cli-mode\n" );

    include_once( 'getopts.php');    

    $parameters = array(
      'noparam'     => 'n',
      'required:'   => 'r:',
      'optional::'  => 'o::',
      'extra::'     => '',
    );

    print "\nparameters:";
    var_export( $parameters );

    print "\nargv:";
    var_export( $argv );

    $_REQUEST    = getopts( $parameters );
} else {
  // Not in cli-mode
}
print "\n\n_REQUEST:";
var_export( $_REQUEST);

/*
print "\n\n_REQUEST:";
print_r( $_REQUEST);
*/


?>