<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 20/03/19
 * Time: 20:56
 */

namespace HGF\Tika;


use Illuminate\Support\ServiceProvider;

class DocumentParserServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app()->singleton('doc-parser', function ($app) {
//            can use config() facade here
            return new DocumentParserManager($app);
        });

        $this->app->singleton('doc-parser.parser', function ($app) {
            return $app['doc-parser']->driver();
        });

//        $this->app()->bind(DocumentParserInterface::class, function ($app) {
//            return $app['doc-parser']->driver();
//        });
    }
}
