<style>
@media(min-width: 0px){
	a:hover{
		opacity:.1;

	}
	.mobile{
		display:block;
		overflow:hidden;
		
		width:200px;
		height:auto;

	}
	.wrapper{
		position:relative;
	}
	.tablet{
		display:none;
	}
	.desktop{
		display:none;
	}
	.xl{
		display:none;
	}
	.bird{
		
		position:absolute;
		bottom:-250px;
	}

}
@media (min-width: 760px) {
	a:hover{
		opacity:.1;
	}
	.mobile{
		display:none;
	}
	.wrapper{
		position:relative;
	}
	.tablet{
		display:block;
	}
	.desktop{
		display:none;
	}
	.xl{
		display:none;
	}
	.bird{

	width:300px;
	height:auto;
	position:absolute;
	bottom:-70px;
	right:-10px;
	align:right;
	
}

}
@media (min-width: 1060px){
	.mobile{
		display:none;
	}

	.tablet{
		display:none;
	}
	.desktop{
		display:block;
	}
	.xl{
		display:none;
	}


.wrapper{
	position:relative;
}
.dirtybird{
	display:block;
	
	
}
.bird{
	
	width:300px;
	height:auto;
	position:absolute;
	bottom:-60px;
	right:-20px;
	align:right;

}
}
@media (min-width: 1220px){
	.mobile{
		display:none;
	}
	.tablet{
		display:none;
	}
	.desktop{
		display:none;
	}
	.xl{
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