<?php
/**
 * This file is part of ( \arabcoders\getid3 ) project.
 *
 * (c) 2017 ArabCoders Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\getid3\Extension\Cache\Interfaces;

interface CacheInterface
{
    public function analyze( string $filename );
}

