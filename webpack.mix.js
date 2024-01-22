const mix = require('laravel-mix');

mix.sass('resources/sass/tabStyle.scss', 'public/css')
	.sass('resources/sass/app.scss', 'public/css')
	.copy('node_modules/mdb-ui-kit/js/mdb.umd.min.js', 'public/js');
