#!/bin/bash

sudo apt-get install nodejs nodejs-legacy npm -y
sudo npm install -g grunt-cli
sudo npm install -g bower

BASEDIR=$(readlink -f "$(dirname $0)/..")

echo "Start develop script..."

echo "Installing node dependencies..."
cd "${BASEDIR}/scripts"
npm install

echo "Running default Grunt task..."
grunt
