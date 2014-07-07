# Byscripts Laravel Starter

### Personal usage

I made this repo for a personal usage, and some default options are specifically mine
(for example my name and my email are in the `workbench.php` options).

So don't be surprised if you want to use this repo as your own starting point.

## Contains

- Laravel 4
- Laravel IDE Helper
- Laravel Twig Bridge
- Bootstrap 3
- FontAwesome 4
- Angular 1.2
- Gulp
- Bower

## Usage

* Download the zip file (or clone project then remove `.git` directory)
* Run `composer update`
* Run `php artisan byscripts:setup`

## Assets

All assets are stored in `assets` directory. They'll be compiled into `public` directory:

- `assets/coffee` => `public/js`
- `assets/scss` => `public/css`
- `assets/img` => `public/img`

## Bower

Bower files are stored in `assets/vendor` directory.

## Gulp

Gulp is used to compile CoffeeScript and Sass files. Optimize images. Copy some files.

One of these tasks copies FontAwesome fonts from vendor to `public/fonts`
