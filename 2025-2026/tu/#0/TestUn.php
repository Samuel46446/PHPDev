<?php

require './vendor/autoload.php';
class TestUn extends PHPUnit\Framework\TestCase
{
    public function testAssert1()
    {
        $this->assertEquals(TRUE,TRUE);
    }
    public function testAssert2()
    {
        $this->assertEquals(TRUE,TRUE);
    }
}
?>