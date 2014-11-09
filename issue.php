<!DOCTYPE html>
<html lang="en">
<head>
    <title>Envolve</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="js/app.js"></script>
    <script src="http://js.pusher.com/1.11/pusher.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <?php
    require('pusher_config.php');
    ?>

    <script>
    var APP_KEY = '<?php echo(APP_KEY); ?>';
    </script>
    
    <script type="text/javascript">
        $(document).ready(function(){
             $("#media-carousel").carousel();
            
            $(function() {
                          $('#commentform').submit(handleSubmit);
                        });
                    });
                    function handleSubmit() {
              var form = $(this);
              var data = {
                "comment_author": form.find('#comment_author').val(),
                "email": form.find('#email').val(),
                "comment": form.find('#comment').val(),
                "comment_post_ID": form.find('#comment_post_ID').val()
              };

              postComment(data);

              return false;
            }

            function postComment(data) {
              // send the data to the server
                $.ajax({
                    type: 'POST',
                    url: 'post_comment.php',
                    data: data,
                    headers: {
                      'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: postSuccess,
                    error: postError
                  });
            }
            function postSuccess(data, textStatus, jqXHR) {
              // add comment to UI
            }

            function postError(jqXHR, textStatus, errorThrown) {
              // display error
            }
        
            //dynamically update the UI
            function postSuccess(data, textStatus, jqXHR) {
              $('#commentform').get(0).reset();
              displayComment(data);
            }

            function displayComment(data) {
              var commentHtml = createComment(data);
              var commentEl = $(commentHtml);
              commentEl.hide();
              var postsList = $('#posts-list');
              postsList.addClass('has-comments');
              postsList.prepend(commentEl);
              commentEl.slideDown();
            }

            function createComment(data) {
              var html = '' +
              '<li><article id="' + data.id + '" class="hentry">' +
                '<footer class="post-info">' +
                  '<abbr class="published" title="' + data.date + '">' +
                    parseDisplayDate(data.date) +
                  '</abbr>' +
                  '<address class="vcard author">' +
                    'By <a class="url fn" href="#">' + data.comment_author + '</a>' +
                  '</address>' +
                '</footer>' +
                '<div class="entry-content">' +
                  '<p>' + data.comment + '</p>' +
                '</div>' +
              '</article></li>';

              return html;
            }

            function parseDisplayDate(date) {
              date = (date instanceof Date? date : new Date( Date.parse(date) ) );
              var display = date.getDate() + ' ' +
                            ['January', 'February', 'March',
                             'April', 'May', 'June', 'July',
                             'August', 'September', 'October',
                             'November', 'December'][date.getMonth()] + ' ' +
                            date.getFullYear();
              return display;
            }
        
            function handleSubmit() {
              var form = $(this);
              var data = {
                "comment_author": form.find('#comment_author').val(),
                "email": form.find('#email').val(),
                "comment": form.find('#comment').val(),
                "comment_post_ID": form.find('#comment_post_ID').val()
              };

              var socketId = getSocketId();
              if(socketId !== null) {
                data.socket_id = socketId;
              }

              postComment(data);

              return false;
            }

            function getSocketId() {
              if(pusher && pusher.connection.state === 'connected') {
                return pusher.connection.socket_id;
              }
              return null;
            }
        
            //TEST
/*            $(function() {

              $(document).keyup(function(e) {
                e = e || window.event;
                if(e.keyCode === 85){
                  displayComment({
                    "id": "comment_1",
                    "comment_post_ID": 1,
                    "date":"Tue, 21 Feb 2012 18:33:03 +0000",
                    "comment": "The realtime Web rocks!",
                    "comment_author": "Phil Leggetter"
                  });
                }
              });

            });*/
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
                <a class="btn btn-default button-mainmenu" href="http://envolvesc.me/issue.php">Create</a>
                <a class="btn btn-default button-mainmenu" href="index.html">About</a>
                <a class="btn btn-default button-mainmenu" href="#">My Issues</a>
            </div>
            <div class="col-md-4">
                <input type="text" class="searchbox left" placeholder="   Search...">
                <button class="glyphicon glyphicon-search btn-search left" type="submit"></button>  
            </div>
        </div>
    </div>
    <div class="col-md-12 maindiv">
        <div class="col-md-8">
            <h1 id="key-issue">Issue</h1>
            <div id="media-carousel" class="carousel slide pad" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#media-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#media-carousel" data-slide-to="1"></li>
                    <li data-target="#media-carousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="images/USC%20landscape.jpg" class="img-responsive" alt="Responsive image">
                        <div class="carousel-caption">
                            <h3 class="white"></h3>
                            <p class="blue"></p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="images/LA%20skyline.jpg" class="img-responsive" alt="Responsive image">
                        <div class="carousel-caption">
                            <h3 class="blue"></h3>
                            <p></p></p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="images/LA%20skyline.jpg" class="img-responsive" alt="Responsive image">
                        <div class="carousel-caption">
                            <h3 class="blue"></h3>
                            <p></p>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#media-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#media-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
            
            <!-- Details -->
            <div class="col-md-12">
                <h2>Detailed Explanation</h2>
                <p id="details">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a faucibus tellus. Vestibulum sodales augue in lectus aliquet, id ultrices justo efficitur. Maecenas at imperdiet ex, eu auctor urna. In viverra ac odio nec faucibus. Pellentesque quis facilisis urna. Duis facilisis magna tincidunt lorem sagittis, eu vehicula tortor semper. Quisque cursus in est cursus fermentum. Phasellus nec felis ac leo porta tincidunt feugiat ac libero. Sed tempor tempor neque, vel iaculis ligula pretium ac. Duis ipsum sapien, facilisis eu porta congue, convallis a massa. Aliquam commodo maximus mi eu rhoncus. Sed venenatis sed lacus sed rutrum. Suspendisse urna tellus, commodo eu libero ut, dapibus gravida leo. Nunc eu pharetra metus. <br /><br />

                Sed sit amet tortor bibendum felis tincidunt aliquet. Aenean eget malesuada enim. Sed varius eu dolor a aliquam. Vivamus lorem felis, finibus nec pulvinar a, pellentesque sit amet purus. Fusce eros eros, mattis luctus sapien a, fermentum sagittis dolor. Suspendisse a justo mi. Pellentesque tellus tortor, ornare id libero sit amet, ornare rutrum erat. Nulla facilisi. Suspendisse sit amet eros finibus, placerat tellus vel, convallis ligula. Etiam id porttitor mauris, sit amet dignissim leo. Vivamus vestibulum non lorem at ullamcorper. Maecenas elit enim, bibendum a nulla sed, bibendum euismod lacus. In laoreet est purus, vitae dignissim neque scelerisque sed. Nunc eget neque nec ligula euismod placerat eu eget nisi. Vivamus turpis elit, tincidunt non blandit ut, mollis vel diam. Donec vitae tristique turpis, at venenatis nisl. <br /><br />
                </p>
            </div>
            <!-- Progress Bar -->
            <div class="col-md-12">
                <h2>Progress</h2>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                        45%
                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-4">
                <h3 class="blue">Summary</h3>
                <h4>Our one-liner:</h4>
                <p class="tab">blahblahblah</p>
                <br />
                <h4>Step Goals</h4>
                <ul>
                    <li>Goal 1</li>
                    <li>Goal 2</li>
                    <li>Goal 3</li>
                </ul>
                <br />
                <h4>Signatures</h4>
                <p class="tab" id="signatures">1533/3000</p>
                <br />
                <h4># Envolved</h4>
                <p id="envolved" class="tab">1590</p>
                <br />
                <h4>Followers</h4>
                <p id="followers" class="tab">1783</p>
            </div>
        </div>
        <!-- Timeline -->
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="col-md-12">
                <h2 class="">Timeline</h2>
                <img src="images/timeline.png" class="img-responsive center-block" alt="Timeline image">
                <hr />
                <!-- Conversations -->
                    <div class="col-md-9">
                        <section id="comments" class="body">
                            <header>
                                <h2 class="darkblue">Conversations</h2>
                            </header>
                            <ol id="posts-list" class="hfeed">
                            </ol>
                        </section>
                        <div id="respond">
                            <h3 class="darkblue">Add to the conversation</h3>
                            <form action="post_comment.php" method="post" id="commentform">
                                <label for="comment" class="required grey">Your message</label>
                                <textarea name="comment" id="comment" rows="10" tabindex="4"  required="required"></textarea>
                                <input type="hidden" name="comment_post_ID" value="<?php echo($comment_post_ID); ?>" id="comment_post_ID" />
                                <input class="pull-right" name="submit" type="submit" value="Submit comment" />
                            </form>  
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h2 class="darkblue">Goals/Topics</h2>
                        <div class="btn-group-vertical">
                            <button type="button" class="btn btn-default">Get 1,000 signatures</button>
                            <button type="button" class="btn btn-default">Obtain support from ______</button>
                            <button type="button" class="btn btn-default">Reach 3,000 signatures</button>
                        </div>     
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-12 footer">
            <p class="text-center">Made with <3 at HackSC</p>
        </div>
</body>
</html>