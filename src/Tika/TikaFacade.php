<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 20/03/19
 * Time: 23:25
 */

namespace HGF\Tika\Tika;


use Illuminate\Support\Facades\Facade;

class TikaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tika';
    }
}
