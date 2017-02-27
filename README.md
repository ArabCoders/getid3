getid3
======

[![Build Status](https://secure.travis-ci.org/ArabCoders/getid3.png?branch=master)](http://travis-ci.org/ArabCoders/getid3)

This is a fork of the trusty [getID3](https://github.com/JamesHeinrich/getID3) library, by James Heinrich updated and refactored to follow modern coding practices, this fork will only work on **PHP 7+ and higher**. 

Install via [composer](http://getcomposer.org/)
------------------------------------------

```bash
$ composer require "arabcoders/getid3"
```

Quick usage example reading audio properties
------------------------------------------

```php
<?php
namespace My\Project;

use \arabcoders\GetId3\GetId3Core;

class MyClass
{
    private function method()
    {
        $mp3File = '/path/to/file.mp3';
        $getId3  = new GetId3Core();
        
        $audio = $getId3->setOptionMD5Data( true )
                        ->setOptionMD5DataSource( true )
                        ->setEncoding( 'utf-8' )
                        ->analyze( $mp3File );

        if ( isset( $audio['error'] ) ) 
        {
            $message = sprintf( 'Error at reading audio properties from "%s" with GetId3: %s.', $mp3File, $audio['error'] );
            throw new \RuntimeException($message);
        }
        
        $this->setLength( $audio['playtime_seconds'] ?? '' );
    }
    private function setLength( $length )
    {
        return $length;   
    }
}
```