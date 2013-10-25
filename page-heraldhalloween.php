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

<p class="tagger">Tweet your Halloween costume pics on October 25th or 26th @BadgerHerald on Twitter using #HeraldHalloween for your chance to WIN ONE OF THE FOLLOWING PRIZES:  <strong>A month of UNLIMITED yoga from Inner Fire Yoga</strong>, <strong>A $50 Toppers Pizza giftcard</strong>, <strong>A free ride and hat from CYC</strong>, <strong>7 free ice cream coupons from Chocolate Shoppe Ice Cream</strong>,  <strong>5 free drinks from Steepery Tea Bar</strong>

<p>

<p class="tagger-button"><a href="https://twitter.com/intent/tweet?button_hashtag=HeraldHalloween" class="twitter-hashtag-button" data-size="large" data-related="willhaynes">Tweet #HeraldHalloween</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></p>


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