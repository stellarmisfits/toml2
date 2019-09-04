<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use TestCaseSeeder;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    /**
     * @var TestCaseSeeder
     */
    public $seeder;

    public function setUp(): void
    {
        parent::setUp();

        $this->seeder = new TestCaseSeeder();
    }
}
