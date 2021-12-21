<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\MovieComposer;
use Illuminate\Support\Facades\Schema;
use App\Models\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $languagelist = Language::all();
        
        $test = "Hello this is test view comoser";
        view()->share('restview',  $test);
        view()->share('languagelist',  $languagelist);
        $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
        /*$tr->setSource('en'); // Translate from English
         if(\Session::has('my_locale')){
             
             echo "<pre>";print_r(\Session::get('my_locale'));die();
             $tr->setTarget(\Session::get('my_locale'));
               
                 

        }else{
              
             $tr->setSource('en'); // Detect language automatically
        }
        view()->share('tr',  $tr);*/
 
        /*view()->composer('blog.blog_edit',  'App\Http\ViewComposers\MovieComposer');*/

         Schema::defaultStringLength(191);

        /* View::composer( views: ['blog.list', 'blog.blog_edit'], callback: function($view){
            $view->with('latestMovie', MovieComposer::class);
        });*/
        View::composer(['blog.list', 'blog.blog_edit'], MovieComposer::class);
        //
    }
}
