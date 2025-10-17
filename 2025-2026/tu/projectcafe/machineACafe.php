<?php
class MachineACafe {
    private $cafe = 1000;
    private $lait = 500;
    private $sucre = 200;

    public function prepare($cafe) {
        if ($this->encoreDuCafe()) {
            $this->cafe = $this->cafe -$cafe->getCafe();

            switch (get_class($cafe))
            {
                case get_class($cafe)=='Macchiato':
                    $this->verserSucre($cafe);
                    break;
                case get_class($cafe)=='Latte':
                    $this->verserLait($cafe);
                    break;
            }
            if (get_class($cafe)=='Macchiato') {
                //verser le sucre pour ce cafe
            }

        }
    }

    public function verserSucre($cafe) {
        $this->sucre = $this->sucre - $cafe->getSucre();
    }

    public function verserLait($cafe) {
        $this->lait = $this->lait - $cafe->getLait();
    }

    public function encoreDuCafe() {
        //y a t il encore du café dans la machine?
        //booleen TRUE/FALSE
        return $this->cafe > 0;
    }

    public function getCafe(): int {
        return $this->cafe;
    }

    public function getSucre(): int {
        return $this->sucre;
    }

    public function getLait(): int
    {
        return $this->lait;
    }

    public function __toString()
    {
        return "cafe: ".$this->cafe." | lait: ".$this->lait." | sucre: ".$this->sucre;
    }
}
?>