<?php

class Entreprise
{
    private string $nom;
    private array $employes;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
        $this->employes = [];
    }

    public function addEmploye(Personne $employe): void
    {
        $this->employes[] = $employe;
    }

    public function getPersonneNonSecure(): array
    {
        return array_filter($this->employes, function($employe) {
            return !($employe instanceof PersonneSecure);
        });
    }

    public function nbPersonneNonSecure(): int
    {
        return count($this->getPersonneNonSecure());
    }

    public function getPersonneSecure()
    {
        return array_filter($this->employes, function($employe) {
            return $employe instanceof PersonneSecure;
        });
    }

    public function nbPersonneSecure()
    {
        return count($this->getPersonneSecure());
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmployes(): array
    {
        return $this->employes;
    }

    public function toXML(): string
    {
        $xml = "<Entreprise nom=\"{$this->nom}\">\n";
        foreach ($this->employes as $employe) {
            if ($employe instanceof XMLable) {
                $xml .= "  " . str_replace("\n", "\n  ", $employe->toXML()) . "\n";
            }
        }
        $xml .= "</Entreprise>";
        return $xml;
    }
}