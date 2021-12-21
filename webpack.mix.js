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
 
  mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .postCss('resources/css/my.css', 'public/css');;
    mix.combine([
      'resources/template_assets/assets/vendor/animate.css/animate.min.css',
      'resources/template_assets/assets/vendor/aos/aos.css',
      'resources/template_assets/assets/vendor/bootstrap/css/bootstrap.min.css',
      'resources/template_assets/assets/vendor/bootstrap-icons/bootstrap-icons.css',
      'resources/template_assets/assets/vendor/boxicons/css/boxicons.min.css',
      'resources/template_assets/assets/vendor/glightbox/css/glightbox.min.css',
      'resources/template_assets/assets/vendor/remixicon/remixicon.css',
      'resources/template_assets/assets/vendor/swiper/swiper-bundle.min.css',
      'resources/template_assets/assets/css/style.css',
      'resources/template_assets/login_form_template/bootstrap.min.css',
      'resources/template_assets/login_form_template/mystyle.css'
  ], 'public/template_assets/css/main.css');
    mix.combine([
      'resources/template_assets/login_form_template/jquery.min.js', 
      'resources/template_assets/assets/vendor/aos/aos.js', 
      'resources/template_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
      'resources/template_assets/assets/vendor/glightbox/js/glightbox.min.js',
      'resources/template_assets/assets/vendor/isotope-layout/isotope.pkgd.min.js',
      'resources/template_assets/assets/vendor/php-email-form/validate.js',
      'resources/template_assets/assets/vendor/swiper/swiper-bundle.min.js',
      'resources/template_assets/assets/js/main.js',
      'resources/template_assets/login_form_template/bootstrap.min.js'
  ], 'public/template_assets/js/main.js');
  mix.combine([
      'resources/js/custom.js'
  ], 'public/js/custom.js');

   mix.options({ processCssUrls: false })
  .copy('resources/template_assets/assets/vendor/bootstrap-icons/fonts', 'public/template_assets/css/fonts')


  mix.options({ processCssUrls: false })
  .copy('resources/template_assets/assets/vendor/boxicons/fonts/boxicons.woff2', 'public/template_assets/fonts')
  .copy('resources/template_assets/assets/vendor/remixicon/remixicon.ttf', 'public/template_assets/css')
  .copy('resources/template_assets/assets/vendor/remixicon/remixicon.woff', 'public/template_assets/css')
  .copy('resources/template_assets/assets/vendor/remixicon/remixicon.woff2', 'public/template_assets/css')

    // mix.js('resources/template_assets/assets/vendor/aos/aos.js', 'public/template_assets/vendor/aos/aos.js')
    //    .js('resources/template_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js', 'public/template_assets/vendor/bootstrap/js/bootstrap.bundle.min.js')
    //    .js('resources/template_assets/assets/vendor/glightbox/js/glightbox.min.js', 'public/template_assets/vendor/glightbox/js/glightbox.min.js')
    //    .js('resources/template_assets/assets/vendor/isotope-layout/isotope.pkgd.min.js', 'public/template_assets/vendor/isotope-layout/isotope.pkgd.min.js')
    //    .js('resources/template_assets/assets/vendor/php-email-form/validate.js', 'public/template_assets/vendor/php-email-form/validate.js')
    //    .js('resources/template_assets/assets/vendor/swiper/swiper-bundle.min.js', 'public/template_assets/vendor/swiper/swiper-bundle.min.js')
    //    .js('resources/template_assets/assets/js/main.js', 'public/template_assets/assets/js/main.js')
    //    .postCss('resources/template_assets/assets/vendor/animate.css/animate.min.css', 'public/template_assets/vendor/animate.css/animate.min.css')
    //    .postCss('resources/template_assets/assets/vendor/aos/aos.css', 'public/template_assets/vendor/aos/aos.css')
    //    .postCss('resources/template_assets/assets/vendor/bootstrap/css/bootstrap.min.css', 'public/template_assets/vendor/bootstrap/css/bootstrap.min.css')
    //    .postCss('resources/template_assets/assets/vendor/bootstrap-icons/bootstrap-icons.css', 'public/template_assets/vendor/bootstrap-icons/bootstrap-icons.css')
    //    .postCss('resources/template_assets/assets/vendor/boxicons/css/boxicons.min.css', 'public/template_assets/vendor/boxicons/css/boxicons.min.css')
    //    .postCss('resources/template_assets/assets/vendor/glightbox/css/glightbox.min.css', 'public/template_assets/vendor/glightbox/css/glightbox.min.css')
    //    .postCss('resources/template_assets/assets/vendor/remixicon/remixicon.css', 'public/template_assets/vendor/remixicon/remixicon.css')
    //    .postCss('resources/template_assets/assets/vendor/swiper/swiper-bundle.min.css', 'public/template_assets/vendor/swiper/swiper-bundle.min.css')
    //    .postCss('resources/template_assets/assets/css/style.css', 'public/template_assets/assets/css/style.css');;

       mix.copy( 'resources/template_assets/assets/img', 'public/template_assets/img', false );

