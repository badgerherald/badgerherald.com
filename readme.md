# badgerherald.com

Continuous deployment for The Badger Herald's WordPress website. This repo contains both theme files and server configuration to deploy badgerherald.com as a standalone web app.

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

1. Copy `dev.env` to `.env`
2. (optional) If you have a development database, copy it to `/docker/mariadb/install/*.sql`
3. Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Vagrant](https://www.vagrantup.com/downloads.html), then:
4. Run
```
vagrant up
```

In a few minutes a WordPress instance will be available at **[http://192.168.19.69/](https://192.168.19.69/)**

You'll have to click through the browser's self-signed ssl certificate warning the first time you visit the page

#### Configuring WordPress

If you installed with a development database, you're done!

If you didn't, you'll need to continue to install WordPress install and enable the "exa" theme.

#### Setting up badgerherald.test

If you'd like an actual domain name to test with locally, you can map one in your local dns hosts file.

On mac:

```
sudo nano /etc/hosts
```
You will be prompted to enter your password. Add a new line to the end of this file to map badgerherald.test to the IP of the vagrant virtual machine:

```
192.168.19.69  badgerherald.test
```

Save this file by hitting `control + o`. Exit by hitting `control + c`

Then, make sure the URL in `.env` is set to badgerherald.test and reprovision the setup.

#### SSH into the virtual machine created by Vagrant

If you followed the above steps, vagrant will have created a virtual machine running Docker.

You can access the virtual machine with ssh:

```
vagrant ssh
```

You can destroy the virtual machine: `vagrant destroy`. Warning: any changes you made to the WordPress install/database will also be destroyed with the virtual machine. To recreate, just run `vagrant up` again.

#### Interacting with Docker

Docker runs on the virtual machine. The first time you `vagrant up` Docker should also start. If you need to restart Docker, first:

1. SSH into the virtual machine (see above)
2. Navigate to the repo directory: `cd ~/badgerherald.com`
3. Run*:

```
docker-compose up
```

Or, to run in detached mode run:

```
docker-compose up -d
```

_*Because of a bug in provisioning of the virtual machine, You may have to use `sudo` to execute these commands._

## Repository Structure 

The `/src` directory contained all source code. Once compiled, the root of the `/src` becomes the root of the WordPress theme directory created.

The `/docker` directory contains both server configuration files used by docker and vagrant. 

The `/wp-content` folder is mapped to docker's WordPress drive. Stencil compiles the theme directly to `/wp-content/themes/badgerherald.com`.

## webpress

As part of Stencil compile webpress adds to functions.php the necessary logic to enqueue scripts and enable some additional WordPress API routes. 

webpress provides a typed javascript API for loading data from WordPress allowing you to write Web Components with no php!
