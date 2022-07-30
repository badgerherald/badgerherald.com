# badgerherald.com

Continuous deployment for The Badger Herald's WordPress website. This repo contains both theme files and server configuration to deploy badgerherald.com as a standalone web app.

**Overview of components:**

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
2. Install docker
3. (optional) If you have a development database, copy it to `/config/mariadb/install/*.sql`
4. Run

```
docker-compose up -d
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

#### Interacting with Docker

Run:

```
docker-compose up
```

Or, to run in detached mode run:

```
sudo docker-compose up -d
```

You may also hit `cmd + z` to detach without stopping the docker containers.

## Repository Structure

The `./src` directory contained all source code. Once compiled, the root of the `./src` becomes the root of the WordPress theme directory created.

The `./config` directory contains both server configuration files used by docker.

The `./bin/wp-content` folder is mapped to docker's WordPress drive. Stencil compiles the theme directly to `./bin/wp-content/themes/badgerherald.com`.

## webpress

As part of Stencil compile webpress adds to functions.php the necessary logic to enqueue scripts and enable some additional WordPress API routes.

webpress provides a typed javascript API for loading data from WordPress allowing you to write Web Components with no php!

## Compiling legacy sass:

```
sass src/theme/sass/style.scss:bin/wp-content/themes/badgerherald.com/style.css
```

## Deploying

Deploying to a new server is almost entirely within the repo.

#1, Deploy a Debian 11 droplet in digital ocean. Remember to:

- Mount in relevant block storage (uploads & plugins dir)
- Allow-list the droplets access to its managed database

#2, SSH into the box and:

```bash
apt update
apt install git
git clone https://github.com/badgerherald/badgerherald.com
bash badgerherald.com/config/provision.sh
```

#3, Mount uploads & plugins block storage and symlink them to `/bin/wp-content/[uploads,plugins]`

#4, Create a .env file at: `~/badgerherald.com/.env` with database and domain details, then:

```bash
cd ~/badgerherald.com
npm install
npm run build
docker compose build
docker compose up
```

To re-deploy changes, run the above again
