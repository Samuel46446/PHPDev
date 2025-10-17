<?php
require '.././vendor/autoload.php';
require_once 'machineACafe.php';
require_once 'cafe.php';
require_once 'expresso.php';
require_once 'macchiato.php';
require_once 'latte.php';

//$mc=new MachineACafe();
//
//echo "niveaux ",$mc,PHP_EOL;
//
//echo "servir un expresso:",PHP_EOL;
//$mc->prepare(new Expresso());
//echo "niveaux ",$mc,PHP_EOL;
//
//echo "servir un macchiato:",PHP_EOL;
//$mc->prepare(new Macchiato());
//echo "niveaux ",$mc,PHP_EOL;

//echo "servir un latte:",PHP_EOL;
//echo "niveaux ",$mc,PHP_EOL;

class CafeTest extends PHPUnit\Framework\TestCase
{
    private MachineACafe $mc;

    public function setUp(): void
    {
        $this->mc = new MachineACafe();
        $this->mc->prepare(new Latte());
    }

    public function testLatte()
    {
        self::assertEquals(490, $this->mc->getLait(), "Y a pas eu de Latte :'(");
    }
}

?>