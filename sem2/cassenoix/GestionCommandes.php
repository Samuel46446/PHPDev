<?php

class GestionCommandes
{
    private string $ipBase;
    private int $port;
    private string $nomDB;

    public function __construct(string $ipBase, int $port, string $nomDB)
    {
        $this->ipBase = $ipBase;
        $this->port = $port;
        $this->nomDB = $nomDB;
    }

    public function getDistributeur()
    {
    }

    public function XMLNonLivrees()
    {
    }
}