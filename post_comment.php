<?php
    require('Persistence.php');

    $db = new Persistence();
    if( $db->add_comment($_POST) ) {
      header( 'Location: index.php' );
    }
    else {
      header( 'Location: index.php?error=Your comment was not posted due to errors in your form submission' );
    }
