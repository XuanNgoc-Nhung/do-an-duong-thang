const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/admin-quan-ly-danh-muc.js', 'public/js/admin-quan-ly-danh-muc.js')
    .js('resources/js/admin-quan-ly-san-pham.js', 'public/js/admin-quan-ly-san-pham.js')
    .js('resources/js/admin-quan-ly-don-hang.js', 'public/js/admin-quan-ly-don-hang.js')
    .js('resources/js/admin-quan-ly-nguoi-dung.js', 'public/js/admin-quan-ly-nguoi-dung.js')
    .js('resources/js/all-products.js', 'public/js/all-products.js')
    .js('resources/js/user-home.js', 'public/js/user-home.js')
    .js('resources/js/detail-product.js', 'public/js/detail-product.js')
    .js('resources/js/booking-product.js', 'public/js/booking-product.js')
    .js('resources/js/booking-list.js', 'public/js/booking-list.js')
    .options({
        processCssUrls: false
    })
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
