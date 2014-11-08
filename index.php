<?php
    require('Persistence.php');
    $comment_post_ID = 1;
    $db = new Persistence();
    $comments = $db->get_comments($comment_post_ID);
    $has_comments = (count($comments) > 0);