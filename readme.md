## badgerherald.com

Docker container hosting The Badger Herald.

#### Developing

To run locally, clone repo. Then:

1. Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Vagrant](https://www.vagrantup.com/downloads.html)
2. Copy `server.env.sample` to `server.env`.

Then, from repo directory root run:

```
vagrant up
```

In a few minutes a local version of badgerherald.com will be available at **[http://192.168.19.69/](http://192.168.19.69/)**

#### Deploying

Target: [Debian Buster](https://www.debian.org/releases/buster/)

To **deploy** clone repo to home directory. Then run:

```
bash server/provision.sh
```