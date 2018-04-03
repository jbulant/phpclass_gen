<?php
  $templatemissingmsg = '[ERROR]        : /!\\ WARNING /!\\ ClassName.class.php not found' . PHP_EOL
                      . '[PHPCLASS_GEN]                     Please reinstall the phpclass generator' . PHP_EOL
                      . '                                   or take a look if filename has been changed.' . PHP_EOL;

  $path = str_replace( 'phpclass_gen.php', '', $argv[0] );

  if ( isset( $argv[1] ) ) {

    $invalidcharmsg = '[ERROR]        : Name must begin by an upper letter' . PHP_EOL
                    . '[PHPCLASS_GEN]   pattern matching = [a-zA-Z\d_]' . PHP_EOL;
    $invalidname = '[ERROR]        : ' . $argv[1] . '.class.php' . PHP_EOL
                    . '[PHPCLASS_GEN]   already exists' . PHP_EOL;

    $name = $argv[1];

    if ( preg_match( '/[^a-zA-Z\d\_]+/', $name ) || !ctype_upper( str_split( $name)[0] ) ) {
      print( $invalidcharmsg );
      return;
    }
    if ( file_exists( $name . 'class.php' ) !== FALSE ) {
    print ( $invalidname );
    return;
    }

    $name = $name;

  } else {
    if (file_exists('untitled.class.php')) {

      $maxuntitledfilesmsg = '[ERROR]        : max limits of untitled files has been reached.' . PHP_EOL
                           . '[PHPCLASS_GEN]   you\'ve REALLY created a thousand untitled files ?!' . PHP_EOL;

      $i = 0;
      while (++$i < 1000)
        if ( file_exists( 'untitled_'.$i.'.class.php' ) === FALSE )
          break;
      if ($i == 1000) {
        print( $maxuntitledfilesmsg );
        return;

      }

      $name = 'untitled_'.$i ;
    } else
      $name = 'untitled' ;
  }

  if ( !file_exists( $path . 'ClassName.class.php' ) ) {
    print( $templatemissingmsg );
    exit ( 1 );
  }

  $newfile = file_get_contents( $path . 'ClassName.class.php' );
  $newfile = str_replace( 'ClassName' , $name , $newfile );
  file_put_contents( $name . '.class.php' , $newfile );
  print ( $name . '.class.php has been created with success.' . PHP_EOL );
?>
