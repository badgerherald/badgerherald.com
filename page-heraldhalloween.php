<?php
/**
 * Template for #heraldhalloween
 *
 * @package WordPress
 * @subpackage exa
 * 
 */

get_header();
?>

<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Amatic+SC:400,700:latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>

<?php /* The loop */ ?>


<h1 class="heraldhalloween"><a href="http://badgerherald.com/heraldhalloween" >#HERALDHALLOWEEN</a></h1>

<p></p>

<div class="post">
    
    <div class="costume-img">
        <img src="http://distilleryimage1.ak.instagram.com/9d0d49d83ccb11e3be2122000a9e08ba_7.jpg" />
    </div>
    <div class="tweet">
        <img class="avatar" src="https://pbs.twimg.com/profile_images/378800000601425068/f0a2de8c7346eef1042d895e1c89d0b5_normal.png" width="40px" height="40px"/>
        <div class="tweet-right">
            <p><a href="http://twitter.com/BadgerHerald">The Badger Herald <span class="username">@BadgerHerald</span></a></p>
            <p>OUR #HeraldHalloween COSTUME CONTEST BEGINS TODAY. Tweet us your pics and you can win big! http://t.co/TPzi1CQ9TA</p>
            <p></p>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="post">
    
    <div class="costume-img">
        <img src="http://distilleryimage1.ak.instagram.com/9d0d49d83ccb11e3be2122000a9e08ba_7.jpg" />
    </div>
    <div class="tweet">
        <img class="avatar" src="" width="40px" height="40px"/>
        <div class="tweet-right">
            <p><a href="http://twitter.com/BadgerHerald">The Badger Herald <span class="username">@BadgerHerald</span></a></p>
            <p>OUR #HeraldHalloween COSTUME CONTEST BEGINS TODAY. Tweet us your pics and you can win big! http://t.co/TPzi1CQ9TA</p>
            <p></p>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="post">
    
    <div class="costume-img">
        <img src="http://distilleryimage1.ak.instagram.com/9d0d49d83ccb11e3be2122000a9e08ba_7.jpg" />
    </div>
    <div class="tweet">
        <img class="avatar" src="" width="40px" height="40px"/>
        <div class="tweet-right">
            <p><a href="http://twitter.com/BadgerHerald">The Badger Herald <span class="username">@BadgerHerald</span></a></p>
            <p>OUR #HeraldHalloween COSTUME CONTEST BEGINS TODAY. Tweet us your pics and you can win big! http://t.co/TPzi1CQ9TA</p>
            <p></p>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/js/async.js" type="text/javascript"></script>
<script src="http://badgerherald.com:3000/socket.io/socket.io.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/heraldhalloween/js/main.js" type="text/javascript"></script>
<?php get_footer(); ?>