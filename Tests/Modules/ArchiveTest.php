<?php

namespace arabcoders\getid3\Tests\Modules;

use arabcoders\getid3\GetId3Core;
use PHPUnit\Framework\TestCase;

class ArchiveTestCase extends TestCase
{
    protected static $zipFile;
    protected static $class;

    protected function setUp()
    {
        $this->markTestIncomplete();
        self::$zipFile = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Fixtures' . DIRECTORY_SEPARATOR . 'zipsample.zip';
        self::$class   = '\\arabcoders\\getid3\\GetId3Core';
    }

    public function testClass()
    {
        $this->assertTrue( class_exists( self::$class ) );
        $this->assertClassHasAttribute( 'option_md5_data', self::$class );
        $this->assertClassHasAttribute( 'option_md5_data_source', self::$class );
        $this->assertClassHasAttribute( 'encoding', self::$class );
        $rc = new \ReflectionClass( self::$class );
        $this->assertTrue( $rc->hasMethod( 'analyze' ) );
        $rm = new \ReflectionMethod( self::$class, 'analyze' );
        $this->assertTrue( $rm->isPublic() );
    }

    public function testZipFile()
    {
        $this->assertFileExists( self::$zipFile );
        $this->assertTrue( is_readable( self::$zipFile ) );
    }

    public function testReadZip()
    {
        $getId3  = new GetId3Core();
        $archive = $getId3
            ->setOptionMD5Data( true )
            ->setOptionMD5DataSource( true )
            ->setEncoding( 'UTF-8' )
            ->analyze( self::$zipFile );

        $this->assertArrayNotHasKey( 'error', $archive );
        $this->assertArrayHasKey( 'mime_type', $archive );
        $this->assertEquals( 'application/zip', $archive['mime_type'] );
        $this->assertArrayHasKey( 'zip', $archive );
        $this->assertArrayHasKey( 'fileformat', $archive );
        $this->assertEquals( 'zip', $archive['fileformat'] );
        $this->assertArrayHasKey( 'encoding', $archive['zip'] );
        $this->assertArrayHasKey( 'files', $archive['zip'] );
        $this->assertArrayHasKey( 'entries_count', $archive['zip'] );
    }
}
