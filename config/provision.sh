#!/bin/bash
#
# provision.sh
#
# 1. Sets clocks
# 2. Install Docker
# 3. Sign ssl certs
# 4. Run
#

# 0. Args
#
DOMAIN="$1"

# 1. Set Clocks
#
echo '👉 setting clocks...'
echo "US/Central" > /etc/timezone
dpkg-reconfigure --frontend noninteractive tzdata
echo 'ntpdate ntp.ubuntu.com' > /etc/cron.daily/ntpdate
chmod +x /etc/cron.daily/ntpdate

# 2. Install Docker
#
echo '👉 apt update & install docker...'
apt update -y
sudo apt-get install -y \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg-agent \
    software-properties-common
curl -fsSL https://download.docker.com/linux/debian/gpg | sudo apt-key add -
sudo add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/debian \
   $(lsb_release -cs) \
   stable"
sudo apt-get update -y
sudo apt-get install docker-ce docker-ce-cli docker-compose-plugin -y

# 3. Install npm + node + sass
#
curl -sL https://deb.nodesource.com/setup_14.x | sudo bash -
sudo apt-get update -y
sudo apt-get install -y nodejs
sudo npm install -g sass

# 4. Run
#
echo '👉 starting docker...'
sudo service docker start
sudo docker network create badgerherald.com-network

echo '✅ finished provision.sh'
