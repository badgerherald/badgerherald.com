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

<?php /* The loop */ ?>


<img src="https://scontent-b-ord.xx.fbcdn.net/hphotos-ash4/1391449_10151907759379235_39144508_n.jpg" />

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