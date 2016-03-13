# Blocks

Blocks make up the basic structure of **exa**, keeping its pieces modular and making changes safe and quick.

## What are blocks?

A blocks is a _full width_ template element with its own set of sass (css) rules. Blocks are tiled down the page, and will eventually support lazy loading to allow additional content to flow down the page.

	todo: add screenshot of blocks highlighted on homepage

## Organization of block files.

Each block has its own `.php` and `.scss` file. 

* The **blockname.php** file lives in `./inc/blocks/` 
* The **_blockname.scss** file lives in `./sass/blocks/`

Note: Older blocks may live outside of these folders. This will be re-organized in the future. 

## How blocks get included.

Blocks are loaded by calling exa_block just like any other template part.

		<?php exa_block('header'); ?>

We're working on a way to pass variables into these files.

## Developing new blocks.

Developing a new block is the best way to add whole new pieces of markup.

### Example

* * *

###### 1. Naming.

Decide on a blockname. Block names should be unique and its output should be easy to understand from its filename. 

* We'll use `alert-banner` for this example. Where you see `alert-banner` replace it with your blocks name.

###### 2. Files.

Create `./inc/blocks/alert-banner.php` and `./sass/blocks/alert-banner.scss`.

###### 3. Including PHP.

Use WordPress function `get_template_part()` to include your new block in whichever template file you're working on.

* ***ex.*** For example, my `alert-banner.php` may be going on the homepage, right under the header. I would edit `homepage.php` and include a call to my block.
```
		<div id="page">

			<?php exa_block('header'); ?>
			<?php exa_block('alert-banner'); ?>
```

###### 4. Including sass.

Include a reference to your sass file in `./sass/style.scss` using `@import`

* ***ex.***  
```
	@import "blocks/alert-banner.scss";
```

###### 5. DOM.

You can now write your php/html code in your block's .php file. 

* ***template.*** Use the following template to set up a basic block:	

```
		/**
		 * Block: alert banner block
		 * Description: Things my block does.
		 *
		 */
		<div class="block alert-banner-block">
			<div class="wrapper">
			<!-- DOM -->
			</div>
		</div>
```

* Replace the classname alert-banner-block with your blocks name ending in -block.
* The outer `div.block.alert-banner-block` spans the entire browsers width. If you'd like to change the background of the block, or break out of the page, use this div.
* The inner `div.wrapper` makes each block a uniform width and centers them on the screen. Generally this is where your code will go.

###### 6. Style

After writing some code, you can style that code:

* **exa** is designed to be mobile first. Define your mobile styles first, and adjust that style accordingly for larger screens.
* ***template.*** Use the following template to set up you `.scss` file.

```
	/**
	 * Alert Banner Block
	 * ---------------------------------------------------------
	 * php: ./inc/blocks/alert-banner.php
	 * since: 0.3
	 * -----------------------------------------------------------------------------
	 */
	
	.alert-banner-block {
		/* mobile and up style */
	}
	
	@include breakpoint(tablet) {
		.alert-banner-block {
			/* tablet and up style */
		}
	}

	@include breakpoint(desktop) {
		.alert-banner-block {
			/* desktop and up style */
		}
	}

	@include breakpoint(xl) {
		.alert-banner-block {
			/* xl desktop and up style */
		}	
	}
```


