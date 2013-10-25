(function($) {
  'use strict';

  // Super-hacky function for formatting text better in the tweets
  function format_tweet(text) {
    // Links
    text = text.replace(/(https?:\/\/[^\s]+)/gi,
                        '<a href="$1">$1</a>');
    // #tags
    text = text.replace(/(#[A-Za-z_]\w*)/gi, function($1) {
      var escaped_tag = encodeURIComponent($1);
      return '<a href="http://twitter.com/search?q='
        + escaped_tag
        + '">' + $1 + '</a>';
    });
    // @mentions
    text = text.replace(/(@\w+)/gi, function($1) {
      var username = $1.substr(1);
      return '<a href="http://twitter.com/' + username + '">' + $1 + '</a>';
    });
    return text;
  }

  function make_post(data) {
    var post = $('<div>').attr('class', 'post');
    post.attr('id', data.id);
    var costume_img = $('<div>').attr('class', 'costume-img');

    var tweet = $('<div>').attr('class', 'tweet');
    var tweet_right = $('<div>').attr('class', 'tweet-right');
    var meta = '<p><a href="http://twitter.com/'
      + data.user.screen_name + '">' + data.user.name + '</a>';

    var body = '<p>' + data.text + '</p>';

    var intents = $('<p>');
    var rt_intent = $('<a>').attr('href', 'http://twitter.com/intent/retweet?tweet_id='+data.id);
    rt_intent.html('Retweet');
    var fav_intent = $('<a>').attr('href', 'http://twitter.com/intent/favorite?tweet_id='+data.id);
    fav_intent.html('Favorite');
    intents.html('Share on Twitter: ');
    intents.append(rt_intent);
    intents.html(intents.html() + ' | ');
    intents.append(fav_intent);

    var avi;
    var img;
    
    async.series([function(callback) {
      if (!data.avi) {
        callback();
      } else {
        avi = $('<img/>').attr('src', data.avi);
        avi.on('load', function() {
          callback();
        });
      }
    }, function(callback) {
      if (!data.img) {
        callback();
      } else {
        img = $('<img/>').attr('class', 'avatar').attr('src', data.img);
        img.on('load', function() {
          callback();
        });
      }
    }], function(err) {
      if (err) {
        console.log(err);
      }
      if (img) {
        costume_img.html(img);
        post.append(costume_img);
      }
      tweet_right.append(meta);
      tweet_right.append(body);
      tweet_right.append(intents);
      tweet.append(avi);
      tweet.append(tweet_right);
      post.append(tweet);
      $('#stream').prepend(post);
    });
  }
  
  var socket = io.connect('http://localhost:3000');
  socket.on('halloween', function(data) {
    make_post(data);
  });
  console.log(socket);
})(jQuery);
