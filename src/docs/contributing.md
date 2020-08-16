# Contributing

Exa is an open source WordPress theme for college media maintained by [The Badger Herald](https://badgerherald.com). We'd love your contributions!

This page will give you a rundown of how you can start contributing.

## Principles:

 1. Keep code maintainable and flexible
 2. Keep code organized and well documented
 3. Think critically about how data is stored
 4. Keep it simple and make it easy for new contributors to get started

#### Coding Standards:

First, follow conventions outlined by **[WordPress Coding Standards](https://codex.wordpress.org/WordPress_Coding_Standards)**.

Some additional conventions we use include:

 1. **Prefixes**: All functions should be prefixed with either `exa_*_` or `_exa_*_`. 
 	- The underscore is used to indicate scope. Functions which should not be called by outside developers should always start with an underscore. This includes methods passed to filters and actions. 
 	- Think of the `*` as an internal prefix that should precede a collection of functions related to common functionality. For example, functions in `./functions/social.php` are all prefixed `_exa_social_`

 2. **Documentation**: Public functions (those starting with `exa_` should have accurate documentation.

 2. **Readability**: Code is not complete until its been edited to remove complexity and improve clarity. Fewer lines of code doesn't mean better code. Don't optimize for the fewest lines of code if it makes the code less clear -- in fact, do the opposite.
 
#### Good readings:

 1. **[Pattern driven markup](https://24ways.org/2015/putting-my-patterns-through-their-paces/)** - _Each page of the site is, as you might guess, stitched together from a host of tiny, reusable patterns. Some of them, like the search form and footer, are fairly unique, and used once per page; others are used more liberally, and built for reuse._

 2. **[Clean Code](https://www.amazon.com/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882)** - A great book to read if you'd like to start writing better more maintainable code. This book will make you a better developer.

## Tools

Exa is a WordPress theme built for college media. It's built with mantainability and extendability in mind, and to make it easy for new developers to join the team and get up to speed.

To make things run effeciently our development enviornments are bundled with a collection of tools. This is not an exhaustive list, but what you need to know to get up and running.

##### WordPress

We use a self hosted install of WordPress from WordPress.org.

**What you need to know:** If you've never used WordPress start by signing up for an account on [WordPress.com](https://wordpress.com). Mess around with this blog to learn the vocabulary and conventions that WordPress employs. Keep in mind that this is the *commercial* side of WordPress. While we use the same software, we host and support ourselves.

##### Vagrant

Vagrant is not technically necessary, but makes it easy to run a local webserver with all the same software as the production server.

**What you need to know:** Follow the steps to getting Vagrant up and running at [badgerherald/bhrld.dev](https://github.com/badgerherald/badgerherald.test).

##### Git


We use Git for both for source control and to coordinate our development efforts.

Using Git allows us to [host our entire codebase on GitHub](https://github.com/badgerherald/exa). You can even see the files that generate these docs on GitHub [here](https://github.com/badgerherald/exa/tree/master/docs).

We also use GitHub to [track issues and future enhancements](https://github.com/badgerherald/exa/issues). Doing this allows us to track changes to our doce and keep a record of versions.

Learning Git can be a little challenging, but it's a great skill to have!

**Resources:** 
- [Github for Journalists](https://knightlab.northwestern.edu/2013/06/13/getting-github-why-journalists-should-know-and-use-the-social-coding-site/) - A simple overview of what Git and GitHub are, geared towards journalists.
- [Git for the Lab](http://newton.cx/%7Epeter/files/git-lab-handout.pdf) - A professors guide to Git for science students
- [try.github.io](https://try.github.io/). Git is ultimately a command line tool. This tutorial walks you through how to create and manage a "repo" at the command line.
- [GitHub Desktop](https://desktop.github.com/) - Don't like the command line? GitHub's desktop app will let you do everything you need to do.




