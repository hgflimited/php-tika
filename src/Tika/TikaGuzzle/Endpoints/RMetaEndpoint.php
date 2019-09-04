<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 21/03/19
 * Time: 11:50
 */

namespace HGF\Tika\Tika\TikaGuzzle\Endpoints;

use HGF\Tika\Tika\TikaGuzzle\Requests\MetaRequest;
use HGF\Tika\Tika\TikaGuzzle\Requests\RMetaRequest;
use HGF\Tika\Tika\TikaGuzzle\Responses\MetaResponse;
use HGF\Tika\Tika\TikaGuzzle\Responses\RMetaResponse;

class RMetaEndpoint extends AbstractTikaGuzzleEndpoint
{
    protected $_requestClass = RMetaRequest::class;
    protected $_responseClass = RMetaResponse::class;
}
