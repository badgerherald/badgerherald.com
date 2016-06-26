# Containers

Containers make up the basic structure of **exa**, keeping its pieces modular and making changes safe and quick.

## What are Containers?

A container is a _full width_ template element with its own set of sass (css) rules. Containers are tiled down the page, and will eventually support lazy loading to allow additional content to flow down the page.

	todo: add screenshot of Containers highlighted on homepage

## Organization of Container files.

Each container has its own `.php` and `.scss` file. 

* The **Containername.php** file lives in `./inc/containers/` 
* The **_Containername.scss** file lives in `./sass/containers/`

Note: Older containers may live outside of these folders. This will be re-organized in the future. 

## How Containers get included.

Containers are loaded by calling `exa_container`.

		<?php exa_container('header'); ?>

We're working on a way to pass variables into these files.

## Developing new Containers.

Developing a new container is the best way to add whole new pieces of markup.

### Example

* * *

###### 1. Naming.

Decide on a containername. Container names should be unique and its output should be easy to understand from its filename. 

* We'll use `alert-banner` for this example. Where you see `alert-banner` replace it with your Containers name.

###### 2. Files.

Create `./inc/containers/alert-banner.php` and `./sass/containers/alert-banner.scss`.

###### 3. Including PHP.

Use Exa function `exa_container()` to include your new container in whichever template file you're working on.

* ***ex.*** For example, my `alert-banner.php` may be going on the homepage, right under the header. I would edit `homepage.php` and include a call to my container.
```
		<div id="page">

			<?php exa_container('header'); ?>
			<?php exa_container('alert-banner'); ?>
```

###### 4. Including sass.

Include a reference to your sass file in `./sass/style.scss` using `@import`

* ***ex.***  
```
	@import "containers/alert-banner.scss";
```

###### 5. DOM.

You can now write your php/html code in your Container's .php file. 

* ***template.*** Use the following template to set up a basic Container:	

```
		/**
		 * Container: alert banner Container
		 * Description: Things my Container does.
		 *
		 */
		<div class="container alert-banner">
			<div class="wrapper">
			<!-- DOM -->
			</div>
		</div>
```

* Replace the classname alert-banner-container with your containers name ending in -container.
* The outer `div.container.alert-banner-container` spans the entire browsers width. If you'd like to change the background of the container, or break out of the page, use this div.
* The inner `div.wrapper` makes each container a uniform width and centers them on the screen. Generally this is where your code will go.

###### 6. Style

After writing some code, you can style that code:

* **exa** is designed to be mobile first. Define your mobile styles first, and adjust that style accordingly for larger screens.
* ***template.*** Use the following template to set up you `.scss` file.

```
	/**
	 * Alert Banner Container
	 * ---------------------------------------------------------
	 * php: ./inc/containers/alert-banner.php
	 * since: 0.3
	 * -----------------------------------------------------------------------------
	 */
	
	.container.alert-banner {
		/* mobile and up style */
	}
	
	@include breakpoint(tablet) {
		.container.alert-banner {
			/* tablet and up style */
		}
	}

	@include breakpoint(desktop) {
		.container.alert-banner {
			/* desktop and up style */
		}
	}

	@include breakpoint(xl) {
		.container.alert-banner {
			/* xl desktop and up style */
		}	
	}
```


