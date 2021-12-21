<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Language {

    public function __construct(Application $app, Request $request) {
        $this->app = $app;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $translate_lang = new GoogleTranslate();
        $translate_lang->setSource('en');
         
        if(\Session::has('my_locale')){
                 \App::setLocale(\Session::get('my_locale')); 
                $translate_lang->setTarget(\Session::get('my_locale'));
                \Illuminate\Support\Facades\View::share('translate_lang', $translate_lang);


        }else{
                \App::setLocale(config('app.locale')); 
                 $translate_lang->setSource('en');
                 \Illuminate\Support\Facades\View::share('translate_lang', $translate_lang);
        }
        
        return $next($request);
    }

}
