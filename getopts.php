<?php

if ( ! function_exists('debug') ){
    include_once( 'debug.php');    
}


/**
 *  @fn        getopts
 *  @brief     Map command line argument list to long options
 *  
 *  @param [in] $parameters	Array of parameters
 *  @return    Long options with parameters
 *  
 *  @details   Given an option list with both short and long options
 *      all short options are mapped to long options
 *      Given the arguments: -r 4 --required=5 -n=1 --extra=9
 *      and 
 *          $parameters = array(
 *            'noparam'     => 'n',
 *            'required:'   => 'r:',
 *            'optional::'  => 'o::',
 *            'extra::'     => '',      // No short opt
 *          );
 *  
 *      -n is mapped to noparam
 *      -r is NOT mapped to "required" since this long option exists
 *  
 *  @example   
 *  
 *      $parameters = array(
 *        'noparam'     => 'n',
 *        'required:'   => 'r:',
 *        'optional::'  => 'o::',
 *        'extra::'     => '',      // No short opt
 *      );
 *
 *      $_REQUEST   = getopts( $parameters );
 *      
 *      var_export( $_REQUEST );
 *  
 *  Called with the arguments½:
 *       -r 4 --required=5 -n=1 --extra=9
 *  returns
 *       array (
 *         'required' => '5',
 *         'extra' => '9',
 *         'noparam' => false,
 *       )
 *  
 *  @example
 *      // Mimick web interface
 *      if (php_sapi_name() == "cli") {
 *          // In cli-mode
 *      
 *          include_once( 'getopts.php');    
 *      
 *          $parameters = array(
 *            'noparam'     => 'n',
 *            'required:'   => 'r:',
 *            'optional::'  => 'o::',
 *            'extra::'     => '',
 *          );
 *      
 *          print "\nparameters:";
 *          var_export( $parameters );
 *      
 *          print "\nargv:";
 *          var_export( $argv );
 *      
 *          $_REQUEST    = getopts( $parameters );
 *      }
 *  
 *  @todo      
 *  @bug       
 *  @warning   
 *  
 *  @see       https://
 *  @since     2022-12-02T06:15:58 / Erik Bachmann Pedersen
 */
function getopts( &$parameters )
{
    debug("Short:[".implode('', array_values($parameters))."]");
    debug("Long:[".implode(', ', array_keys($parameters))."]");
    
    $options = getopt(implode('', array_values($parameters)), array_keys($parameters));

    debug( var_export( $options, TRUE ) );

    foreach ($parameters as $key => $value )
    {
        $normvalue  = str_replace( ':', "", $value);
        $normkey    = str_replace( ':', "", $key);
        debug( "_key[$normkey]val[$normvalue]" );
        
        if ( isset( $options[ $normvalue ] ))
        {
            debug( $normvalue );
            if ( empty( $options[$normkey] )  )
            {   // Move short option to long option
                debug( "Shift: $normvalue:{$options[$normvalue]} -> [$normkey]\n");
                $options[$normkey]    = $options[$normvalue];
            }
            // Remove short option
            unset( $options[$normvalue] );
        }
    }
    return( $options );
}   // getopts()

?>