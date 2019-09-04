<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 21/03/19
 * Time: 11:14
 */

namespace HGF\Tika\Tika\Http;


use Illuminate\Support\Collection;
use SplFileInfo;

interface TikaHttpInterface
{

    /**
     * @param null $endpoint
     * @param array $documents
     * @param array $options
     * @return Collection|TikaResponse
     */
    public function request($endpoint, array $documents = null, $options = []);

    public function parse($endpoint, SplFileInfo $documents = null, $options = []);

    public function verifyConnection();
}
