<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $startTime = null;

    protected $endTime = null;

    protected $processTime = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->startTime = microtime(true);
    }

    protected function tearDown(): void
    {
        $this->endTime = microtime(true);

        $this->processTime = round($this->endTime - $this->startTime, 2);


        print "\n\033[0;33m" . get_called_class() . "\033[0m：";
        print "\033[0;37m" . $this->getName() . "\033[0m";
        print "\033[0;32m（" . $this->processTime . " 秒）\033[0m";

        parent::tearDown();
    }
}

