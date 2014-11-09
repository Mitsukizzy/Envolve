var pusher = new Pusher(APP_KEY);
var channel = pusher.subscribe('comments-' + $('#comment_post_ID').val());
channel.bind('new_comment', displayComment);