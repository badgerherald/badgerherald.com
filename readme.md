# badgerherald.com

The whole taco. This repo contains both server configuration, front-end theming and local development support for The Badger Herald's WordPress website.

**Overview of components:**

- **Docker**. Docker is used to "containerize" the various components that go into hosting the production website. WordPress runs in one container while an Nginx proxy container serves pages from it. Other containers include caching services, metric agents and a development database. Docker is also used for local development, to perfectly mirror the server.

- **Node.js & Stencil**. Stencil is a compiler for generating Web Components. With Stencil it's possible to use more modern development tools like TypeScript and JSX. Stencil will compile web components in `src/components` and copy the results along with other theme code in `src/` to the server's `server/wp-content/theme` directory.

- **webpress**. Webpress is a javascript toolkit for querying the WordPress API. It also includes generic web components—like `<wp-title />`, `<wp-media />`—to abstract rendering WordPress content. I (Will Haynes) wrote it, and it's definitely still a work in progress. Some [**old documentation about webpress is here**](https://wjh.dev/webpress/). You can also find the [**code here**](https://github.com/broadsheet-technology/webpress).

## Contributing

We welcome pull requests, feature ideas or other support from anyone — and in particular from students at The University of Wisconsin. Please reach out if you'd like to get involved. We'd be happy to get you set up (and meet you!) at our offices near W Johnson and State St or on a Zoom call.

### Running the site locally

Running the site locally is a three step process:

1. Clone the repo
2. Compile the theme
3. Build and run the docker containers

#### 1. Clone the repo

(If you're new to Git, consider installing [GitHub Desktop](https://desktop.github.com/))

Run:

```
cd ~/Documents
git clone https://github.com/badgerherald/badgerherald.com
cd badgerherald.com
```

#### 2. Compiling the theme

In order to use sass and stencil the theme needs to be compiled.

1. Install [Node.js & npm](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm). The easiest way to do this is to first install [Homebrew](https://brew.sh/), and then use it to install npm

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
; NOTE: After you run the above line you must also run the commands
; brew prints to add npm to your terminals path

brew install node
```

2. From the root of the repo, run

```bash
npm install
npm run build
```

#### 3. Running a local development server at https://localhost

To run a development WordPress server locally:

1. Copy `dev.env` to `.env`

   ```
   cp dev.env .env
   ```

2. [Install](https://www.docker.com/) & configure Docker

   > You'll need to add a file sharing permission for ~/Documents/badgerherald.com (or wherever you cloned the repo) to Docker. Do this by opening:
   >
   > `Docker Desktop > Preferences > Resources > Filesharing`
   >
   > And adding /Users/your-user/Documents/badgerherald.com

3. (optional) If you have a development database, copy it to `/config/mariadb/install/*.sql`
4. Start docker by running:

   ```
   docker network create badgerherald.com-network
   docker compose build
   docker compose up -d
   ```

In a few minutes a WordPress instance will be available at **[https://localhost/](https://localhost/)**

You'll have to click through the browser's self-signed ssl certificate warning the first time you visit the page

### Configuring WordPress

If you installed with a development database, you're done!

If you didn't, you'll need to continue to install WordPress install and enable the "badgerherald.com" theme.

### Local development server

To watch for changes (during development), run:

```
npm run start
```

This will recompile the theme when any change is detected in `/src`

### Interacting with Docker

After running for the first time, there are some commands that are good to get familiar with

##### Starting Docker

- `docker compose up` — This will run Docker or connect to the running Docker containers and continuously print the Docker log files to the terminal. To quit out of this hit `cmd+c` (maybe repeatedly) or terminate your terminal window
- `docker compose up -d` — Same as above, but will run in detached mode (not printing any logs to the terminal Window)

You'll have to restart Docker containers every time you quit out with `cmd+c`, or if running in detached mode when your computer restarts or hibernates long enough.

Once you have started the containers for the first time you may also start/stop/look at logs directly in Docker Desktop.

##### Compiling the theme

- `npm run build` - This builds the theme once and quits.
- `npm run start` - This launches the compiler in 'watch' mode, automatically recompiling changes (to see them refresh the page). You'll typically want this running while you develop. To quit hit `cmd+c`

There are a few files that running in detached mode will not capture and automatically recompile, but they mainly exist in the old parts of the website.

##### Stopping Docker

- `docker compose down` — Stops any running containers
- `docker compose up -v` — Same as above, but **will also destroy all Docker volumes**. Namely, you'll be left with a fresh database

---

## Repository Structure

The `./src/` directory contained all source code, split into a few areas:

- `./src/components`: This contains all the Stencil JS web component code (what the compiler is primarily watching for changes to)
- `./src/global`: Holds some shared code between `components` and `theme`. Mostly shared CSS so that the components look like the rest of the old site.
- `./src/media-kit`: This is a completely seperate static site definition that gets hosted at advertise.badgerherald.com
- `./src/theme`: This becomes the root of the WordPress theme directory created (e.g. `/bin/wp-content/themes/badgerherald.com`)

The `./config` directory contains both server configuration files used by docker.

The `./bin/wp-content` folder is mapped to docker's WordPress drive. Stencil compiles the theme directly to `./bin/wp-content/themes/badgerherald.com`.

---

## Deployment

#### Deploying a new Production server

Deploying to a new server is almost entirely within the repo.

**#1**—Deploy a Debian 11 droplet in digital ocean. Remember to:

- Mount in relevant block storage (uploads & plugins dir)
- Allow-list the droplets access to its managed database

**#2**—SSH into the box and:

```bash
apt update
apt install git
git clone https://github.com/badgerherald/badgerherald.com
bash badgerherald.com/config/provision.sh
```

**#3**—Mount uploads & plugins block storage and symlink them to `/bin/wp-content/[uploads,plugins]`

**#4**—Create a .env file at: `~/badgerherald.com/.env` with database and domain details, then:

```bash
cd ~/badgerherald.com
npm install
npm run build
docker compose build
docker compose up
```

#### Re-deploying to Production

This could be improved, however today the best way to re-deploy source code changes is run

```
# ssh into the server
ssh badgerherald.com

# build the docker box
docker compose build;

# compile the theme
npm run build

# if both of the above succeed:
docker compose down; docker compose up -d
```

The last line will take the site offline for about 40 seconds while the containers redeploy
