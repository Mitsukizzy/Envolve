<?php
/**
 * Created by PhpStorm.
 * User: Jackychen
 * Date: 10/20/14
 * Time: 3:12 PM
 */
$headline = $_REQUEST['headline'];
$description = $_REQUEST['description'];
$goal_1 = $_REQUEST['goal1'];
$goal_2 = $_REQUEST['goal2'];
$goal_3 = $_REQUEST['goal3'];
//$tags = $_REQUEST['tags_id'];

if(empty($headline) || empty($description) || empty($goal_1)){//  || empty($tags)
    exit("Error: No Event given.");
    header("Location: form.php");
}

$conn = mysqli_connect("uscitp.com", "jackyche_admin", "usc2014", "jackyche_envolve_db");
                        //(server, user, password, database)
if(mysqli_connect_errno()) {
    echo "Connection failed: " . mysqli_connect_error();
}
    /*
         * UPDATE table_name
         * SET column_name = new_value
         *      SET title = 'New Title', genre_id = 5, label_id=10, ..._id=...
         * WHERE primary_key = primary_value
         *      WHERE dvd_title_id = 15
    */

    $insert_sql = "INSERT INTO event (headline, description, goal_1, goal_2, goal_3)
                  VALUES ('" . $headline . "', '" . $description ."', '" . $goal_1 ."', '" . $goal_2 ."', '" . $goal_3 ."');";


    $insert_results = mysqli_query($conn, $insert_sql);

    if (!insert_results) {
        exit("Update SQL Error: " . mysqli_error($conn));
    } else {
        echo "";
    }

$sql = "SELECT * FROM event 
        WHERE headline LIKE '" . $headline . "'";

$results = mysqli_query($conn, $sql);
if(!$results){
    exit("SQL Error: " . mysqli_error($conn));
}

?>

<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="js/app.js"></script>
    <script src="http://js.pusher.com/1.11/pusher.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="navbar menubar">
    <div class="col-md-3 no-margin">
        <img src="images/envolve%20logo.jpg" class="img-responsive" alt="logo">
    </div>
    <div class="col-md-9 main-menu-strip">
        <div class="col-md-8">
            <a class="btn btn-default button-mainmenu" href="#">Browse</a>
            <a class="btn btn-default button-mainmenu" href="#">Create</a>
            <a class="btn btn-default button-mainmenu" href="#">About</a>
            <a class="btn btn-default button-mainmenu" href="#">My Issues</a>
        </div>
        <div class="col-md-4">
            <input type="text" class="searchbox left" placeholder="   Search...">
            <button class="glyphicon glyphicon-search btn-search left" type="submit"></button>
        </div>
    </div>
</div>
<div class="col-md-12 maindiv">
    <h1 id="key-issue">Confirmed!</h1>
    <div class="box" style="font-size: 20px; margin: auto;">
        <br/>
        <?php  
        while($row = mysqli_fetch_array($results)){
            echo '<table>
                <tr>
                    <td class="label">Headline: </td><td>' . $row['headline'] . '</td>
                </tr>
                <tr>
                    <td class="label">Description: </td><td>' . $row['description'] . '</td>
                </tr>
                <tr>
                    <td class="label">1st Goal: </td><td>' . $row['goal_1'] . '</td>
                </tr>
                <tr>
                    <td class="label">2nd Goal: </td><td>' . $row['goal_2'] . '</td>
                </tr>
                <tr>
                    <td class="label">3rd Goal: </td><td>' . $row['goal_3'] . '</td>
                </tr></table>';
            echo "<br/><h2><a href='issue.php?event_id=" . $row['event_id'] . "'> YOUR ISSUE PAGE</a></h2>";
            }
        ?>
    <!-- <tr>
        <td class="label">Tags: </td><td><?php //echo $tags ?></td>
    </tr> -->

    </div>
</div>
    <br/>
</body>
</html>

