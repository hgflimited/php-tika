<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 20/03/19
 * Time: 20:57
 */

namespace HGF\Tika;


use Illuminate\Support\Facades\Facade;

class DocumentParser extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'doc-parser';
    }
}
