<style>
@media(min-width: 0px){
	.dirty-bird-block a{
		opacity:.7;
	}
	.dirty-bird-block a img {
		opacity:.7;
	}
	.dirty-bird-block a:hover {
		opacity: 1;
	}
	.dirty-bird-block a:hover img {
		opacity: 1;
	}
	.dirty-bird-block .mobile{
		display:block;
		overflow:hidden;
		width:100%;
		height:auto;
	}
	.dirty-bird-block .wrapper{
		position:relative;
	}
	.dirty-bird-block .tablet, .desktop, .xl{
		display:none;
	}
	.dirty-bird-block .bird{
		position:absolute;
		bottom:-80px;
		left: 80px;
	}

}
@media (min-width: 760px) {

	.dirty-bird-block .mobile{
		display:none;
	}
	.dirty-bird-block .wrapper{
		position:relative;
	}
	.dirty-bird-block .tablet{
		display:block;
	}
	.dirty-bird-block .desktop{
		display:none;
	}
	.dirty-bird-block .xl{
		display:none;
	}
	.dirty-bird-block .bird{

	width:300px;
	height:auto;
	position:absolute;
	bottom:-70px;
	right:-30px;
	left: auto;
	align:right;
	
}

}
@media (min-width: 1060px){
	.dirty-bird-block .mobile{
		display:none;
	}

	.dirty-bird-block .tablet{
		display:none;
	}
	.dirty-bird-block .desktop{
		display:block;
	}
	.dirty-bird-block .xl{
		display:none;
	}
	.dirty-bird-block .wrapper{
		position:relative;
	}
	.dirty-bird-block .dirtybird{
		display:block;
	}
	.dirty-bird-block .bird{
		width:300px;
		height:auto;
		position:absolute;
		bottom:-60px;
		right:-20px;
		align:right;
	}
}
@media (min-width: 1220px){
	.dirty-bird-block .mobile{
		display:none;
	}
	.dirty-bird-block .tablet{
		display:none;
	}
	.dirty-bird-block .desktop{
		display:none;
	}
	.dirty-bird-block .xl{
		display:block;
	}


}



</style>

<div class="block dirty-bird-block">
	<div class="wrapper">
	
		<a href="http://dirtybird.badgerherald.com">
		<img src = "<?php bloginfo('template_url') ?>/img/dirty-bird/mobile.jpg" class="mobile">
		<img src = "<?php bloginfo('template_url') ?>/img/dirty-bird/tablet.jpg" class="tablet">
		<img src = "<?php bloginfo('template_url') ?>/img/dirty-bird/desktop.jpg" class="desktop">
		<img src = "<?php bloginfo('template_url') ?>/img/dirty-bird/xl.png" class="xl">
		
		<img src = "http://www.animatedimages.org/data/media/591/animated-parrot-image-0130.gif" 
			class='bird'>
		
		
		</a>
	</div>
</div>