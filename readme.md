# badgerherald.com

Continuous deployment for The Badger Herald's WordPress website.

**Overview of components:**

 - **Vagrant**. Vagrant is a wrapper around VirtualBox and allows quick provisioning of virtual machines. The included Vagrantfile will provision a Debian VM for local development mirroring the same configuration as the production website. After being provisioned, Vagrant will install Docker and run the defined containers.

 - **Docker**. Docker is used to "containerize" the various components that go into hosting the production website. WordPress runs in one container while an Nginx proxy container serves pages from it. A third container includes WordPress memcache support and a MariaDB container can be used to host a database for local development.

 - **Node.js & Stencil**. Stencil is a compiler for generating Web Components. With Stencil it's possible to use more modern development tools like TypeScript and JSX. Stencil will compile web components in `src/components` and copy the results along with other theme code in `src/` to the server's `server/wp-content/theme` directory.

## Contributing

We welcome pull requests, feature ideas or other support from anyone — and in particular from students at The University of Wisconsin. Please reach out if you'd like to get involved. We'd be happy to get you set up (and meet you!) at our offices on State Street or on a Zoom call.

## Compiling the theme

In order to use sass and stencil the theme needs to be compiled.

1. Install [Node.js & npm](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm), then:
2. From the root of the repo, run

```
npm install
npm run build
```

To watch for changes (during development) instead run:

```
npm run watch
```

## Running a local development server at https://192.168.19.69

To run a development WordPress server locally:

1. Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Vagrant](https://www.vagrantup.com/downloads.html), then:
2. Run
```
vagrant up
```

In a few minutes a WordPress instance will be available at **[http://192.168.19.69/](https://192.168.19.69/)**

You'll have to click through the browser's self-signed ssl certificate warning the first time you visit the page

#### Configuring WordPress

If you followed the above steps, you'll have a fresh WordPress instances asking you to install WordPress. You'll need to create a new WordPress install and enable the "exa" theme. 

If you don't see the exa theme, make sure you compiled it (instructions above).

## Repository Structure 

All source code is contained in the `/src` directory. Once compiled, the root of the `/src` becomes the root of the theme directory that is compiled.

The `/server` directory contains both server configuration files as well as the `wp-content` folder (created when the WordPress Docker container is first created). `/server/wp-content` is basically the web root of the server.

## webpress

As part of Stencil compile webpress adds to functions.php the necessary logic to enqueue scripts and enable some additional WordPress API routes. 

webpress provides a typed javascript API for loading data from WordPress allowing you to write Web Components with no php!
