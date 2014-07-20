#!/usr/bin/env bash

rm -rf .git
composer update
./artisan byscripts:setup
npm install
bower install
gulp
