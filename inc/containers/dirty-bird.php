<style>
@media(min-width: 0px){
	.dirty-bird-container {
		margin-bottom: -24px;
	}

	.dirty-bird-container a{
		opacity:.7;
	}
	.dirty-bird-container a img {
		opacity:.7;
	}
	.dirty-bird-container a:hover {
		opacity: 1;
	}
	.dirty-bird-container a:hover img {
		opacity: 1;
	}
	.dirty-bird-container .mobile{
		display:container;
		overflow:hidden;
		width:100%;
		height:auto;
	}
	.dirty-bird-container .wrapper{
		position:relative;
	}
	.dirty-bird-container .tablet, .desktop, .xl{
		display:none;
	}
	.dirty-bird-container .bird{
		position:absolute;
		bottom:-80px;
		left: 80px;
		z-index: 10;
	}

}
@media (min-width: 760px) {

	.dirty-bird-container .mobile{
		display:none;
	}
	.dirty-bird-container .wrapper{
		position:relative;
	}
	.dirty-bird-container .tablet{
		display:container;
	}
	.dirty-bird-container .desktop{
		display:none;
	}
	.dirty-bird-container .xl{
		display:none;
	}
	.dirty-bird-container .bird{

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
	.dirty-bird-container .mobile{
		display:none;
	}

	.dirty-bird-container .tablet{
		display:none;
	}
	.dirty-bird-container .desktop{
		display:container;
	}
	.dirty-bird-container .xl{
		display:none;
	}
	.dirty-bird-container .wrapper{
		position:relative;
	}
	.dirty-bird-container .dirtybird{
		display:container;
	}
	.dirty-bird-container .bird{
		width:300px;
		height:auto;
		position:absolute;
		bottom:-60px;
		right:-20px;
		align:right;
	}
}
@media (min-width: 1220px){
	.dirty-bird-container .mobile{
		display:none;
	}
	.dirty-bird-container .tablet{
		display:none;
	}
	.dirty-bird-container .desktop{
		display:none;
	}
	.dirty-bird-container .xl{
		display:container;
	}


}



</style>

<div class="container dirty-bird-container">
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