<?php
$conn = mysqli_connect("uscitp.com", "jackyche_admin", "usc2014", "jackyche_envolve_db");
                        //(server, user, password, database)
if(mysqli_connect_errno()){
    echo "Connection failed: ", mysqli_connect_error();
}

$sql_tags = "SELECT * FROM tags
        ORDER BY tags";
//$sql_TitleDescription = "SELECT * FROM event";
//$sql_goals = "SELECT * FROM goals";

$results_tags = mysqli_query($conn, $sql_tags);
//$results_TitleDescription = mysqli_query($conn, $sql_TitleDescription);
//$results_goals = mysqli_query($conn, $sql_goals);

if(!$results_tags){ // || !$results_TitleDescription || $results_goals
    exit("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Envolve | Issue Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#media-carousel").carousel();
        });
    </script>
</head>

<body>
<div class="navbar menubar">
    <div class="col-md-3 no-margin">
        <a href="index.html">
            <img src="images/envolve%20logo.jpg" class="img-responsive" alt="logo">
        </a>
    </div>
    <div class="col-md-9 main-menu-strip">
        <div class="col-md-8">
            <a class="btn btn-default button-mainmenu" href="browse.html">Browse</a>
            <a class="btn btn-default button-mainmenu" href="http://envolvesc.me/form.php">Create</a>
            <a class="btn btn-default button-mainmenu" href="about.html">About</a>
            <a class="btn btn-default button-mainmenu" href="#">My Issues</a>
        </div>
        <div class="col-md-4">
            <input type="text" class="searchbox left" placeholder="   Search...">
            <button class="glyphicon glyphicon-search btn-search left" type="submit"></button>
        </div>
    </div>
</div>

<div class="col-md-12 maindiv">
    <h1 id="key-issue">Start a Conversation!</h1>

    <!-- Form -->
    <form class="box" method="post" name="form" action="eventInsert.php"> <!-- issue.php -->
        <div class="inputbox">
            <br/>
            <div class="left_col">
            <!-- name is "headline"-->
            What are we talking about here? <span class="glyphicon glyphicon-info-sign"></span>
                <br/><input type="text" class="blackwords" name="headline" size="73">
                    <br/><br/>
            <!-- name is "description"-->
            Tell me about it! <span class="glyphicon glyphicon-info-sign"></span>
                <br/><textarea class="blackwords" name="description" rows="8" cols="77"></textarea>
                    <br/><br/>
            <!-- name is "goal1", "goal2", "goal3"-->
            What do we want accomplished? <span class="glyphicon glyphicon-info-sign"></span><br/>
                1. <input class="blackwords" type="text" name="goal1" size="70" ><br/>
                2. <input class="blackwords" type="text" name="goal2" size="70" ><br/>
                3. <input class="blackwords" type="text" name="goal3" size="70" ><br/><br/>

            <label for='uploaded_file'>Cover Photo: <span class="glyphicon glyphicon-info-sign"></span> </label>
                <input class="blackwords" type="file" name="uploaded_file">
                    <br/>
            </div>
            <!-- right column-->
            <div class="right_col">
            <!-- name is "tags_id"-->
            Tags: <span class="glyphicon glyphicon-info-sign"></span>
                    <br/>
                <div class="blackwords">
                <?php
                while ($currentrow = mysqli_fetch_array($results_tags)) {
                echo '<input type="checkbox" name="' . tags_id . '" value="' . $currentrow["tags_id"] . '"> ' . $currentrow["tags"] . '<br/>';
                }
                ?></div>
            <br/>
            <input type="submit">
                </div>
            <br/><br/>
        </div>
    </form>
    <br/><br/>

</body>
</html>