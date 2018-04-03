<?php

class ClassName {

  private     $_verbose = false;
  private     $_isactive = false;

  public function  __construct( array $args ) {

    if (isset( $args )) {

      foreach ( $args as $key => $value ) {
        $this->_parseParam($key, $value);
      }

    }

    if ( $this->_verbose )
      print( 'ClassName: Constructor called' . PHP_EOL );

    return;

  }

  public function  __destruct() {

    if ( $this->_verbose )
      print( 'ClassName: Destructor called' . PHP_EOL );

    return;

  }

  public function  __toString() {
    print ( 'ClassName: ( ' . ' )' .PHP_EOL );
    return;
  }

  public function  setVerbose( $v ) {

    if (isset( $v )) {
      $this->_verbose = ( ( $v ) ? true : false );
      print( 'ClassName: Verbose ' . ( ( $this->_verbose == true ) ? '( enabled )' : '( disabled )' ) . PHP_EOL );
    }

    return;

  }

  public function  isActive() { return ( $this->_isactive ); }

  public function  setActive( $state ) {

    if (isset($state)) {
      $this->_isactive = ( ( $state ) ? true : false );

      if ($this->_verbose)
        print( 'ClassName: status ' . ( ( $this->_isactive == true ) ? '( enabled )' : '( disabled )' ) . PHP_EOL);
    }

    return;

  }

  public static function  doc() {

    $doc = '[ documentation ] : ClassName(array( =>, ))' . PHP_EOL
         . '                         takes XXX parameters.' . PHP_EOL
         . '  Methods:' .PHP_EOL
         . '    - setVerbose(bool $value) :' . PHP_EOL
         . '      -- can be activate at instantiation with : "verb" => true : false ' . PHP_EOL
         . '        |  Enable/Disable verbose mode of this class.' . PHP_EOL
         . '    - setActive( bool $state ) :' . PHP_EOL
         . '      -- can be activate at instantiation with : "active" => true : false ' . PHP_EOL
         . '        |  - activate/Deactivate - this class.' . PHP_EOL
         . '    - isActive() :' . PHP_EOL
         . '        |  Give the actual status of this class' . PHP_EOL ;
    print( $doc );

    return;

  }

  public static function  default() {
      return new ClassName(array());
  }

  private function _parseParam( $key, $value ) {

    switch ( $key) {
      case 'verb' :
        $this->setVerbose( $value );
        break;
      case 'active' :
        $this->setActive( $value );
        break;
      default :
        print( "Warning[ClassName]: '" . $key . "' unkown parameter." . PHP_EOL );
        return ( -1 );
        break;
    }
    return ( 0 );
  }

}

?>
