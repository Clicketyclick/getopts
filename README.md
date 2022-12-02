# getopts
Map command line argument list to long options ($argv -> $_REQUEST)

Why waist time on getting arguments from both command line (short options AND long options) and figure out wether to use `-f` or `--file` arguments - or HTTP Request variables.

Call: 
```
    include_once( 'getopts.php');    

    $parameters = array(
      'noparam'     => 'n',
      'required:'   => 'r:',
      'optional::'  => 'o::',
      'extra::'     => '',
    );


  $_REQUEST = getopts( $parameters );
```
And you will have the command line arguments (from getopt() ) or HTTP request variables.
