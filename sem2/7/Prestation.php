<?php

class Prestation
{
    private string $libelle;
    private DateTime $dateSoins;
    private DateTime $heureSoins;
    private Intervenant $intervenant;

    public function __construct(string $libelle, DateTime $dateSoins, DateTime $heureSoins, Intervenant $intervenant)
    {
        $this->libelle = $libelle;
        $this->dateSoins = $dateSoins;
        $this->heureSoins = $heureSoins;
        $this->intervenant = $intervenant;
    }

    /**
     * @return Intervenant
     */
    public function getIntervenant(): Intervenant
    {
        return $this->intervenant;
    }

    /**
     * @return DateTime
     */
    public function getDateSoins(): DateTime
    {
        return $this->dateSoins;
    }

    /**
     * @return DateTime
     */
    public function getHeureSoins(): DateTime
    {
        return $this->heureSoins;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * @param Prestation $prestation
     * @return int
     */
    public function compareTo(Prestation $prestation): int
    {
        if($this->dateSoins == $prestation->dateSoins)
        {
            return 0;
        }
        else if($this->dateSoins > $prestation->dateSoins)
        {
            return 1;
        }
        return -1;
    }
}

?>