$(document).ready(function() {

  var $app = $('#app');
  $app.html('');


var $title = $('<h1>Today/s Feed</h1>');
var $newFeed = $('<div id="newFeed"></div>');
var $updateFeedButton = $('<button id="update-feed">Update Feed</button>');
//Event Handler Function starts here:
var handleTitleClick = function(event) {
  alert('The title of this page is: ' + event.target.innerText);
};

var handleUpdateClick = function(event) {
  $newFeed.html('');
  renderFeed();
  $("#update-feed").html("Update Feed");
};

var handleUserNameClick = function(event) {
  $newFeed.html('');
  var username = event.target.innerText.slice(1);
  renderFeed(username);
  $("#update-feed").html("Back");
};

var renderFeed = function (username) {
  if (username) {
    var index = streams.users[username].length - 1;
    var newfeeds = streams.users[username];
  } else {
    var index = streams.home.length - 1;
    var newfeeds = streams.home;
  }
  while(index >= 0){

    var feedw = newfeeds[index];
    var $feedw = $('<div class="feedw"></div>');
    $feedw.appendTo($newFeed);

    var $userName = $('<span class="username"></span>');
    $userName.text('@' + feedw.user);
    $userName.appendTo($feedw);
    $userName.on("click", handleUserNameClick);

    var $timeStamp = $('<span class="timestamp"></span>');
    $timeStamp.text(jQuery.timeago(feedw.created_at));
    $timeStamp.appendTo($feedw);

    index--;

  }
};

//Event Listners:

renderFeed();
$updateFeedButton.on("click", handleUpdateClick);
$title.on("click", handleTitleClick);


$title.appendTo($app);
$updateFeedButton.appendTo($app);
$newFeed.appendTo($app);

});
