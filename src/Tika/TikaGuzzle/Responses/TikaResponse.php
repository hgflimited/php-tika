<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 21/03/19
 * Time: 12:13
 */

namespace HGF\Tika\Tika\TikaGuzzle\Responses;


class TikaResponse extends AbstractTikaGuzzleResponse
{
    public function default()
    {
        $body = $this->_response->getBody();

//        Add magic methods to this class for syntactic niceness too
        return (string) $body;
    }
}
