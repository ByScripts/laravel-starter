#!/usr/bin/env bash

echo "Removing .git directory..."
rm -rf .git 2>&1 >> init.log

echo "Composer update..."
composer update 2>&1 >> init.log

echo "Running Laravel Setup..."
./artisan byscripts:setup

echo "Install NPM libraries..."
npm install 2>&1 >> init.log

echo "Install Bower libraries..."
bower install 2>&1 >> init.log

echo "Running gulp..."
gulp
