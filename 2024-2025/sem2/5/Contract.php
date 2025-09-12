<?php

namespace sem2\5;

use sem2\use sem2\use sem2\use sem2\class Contract
{
    private
    int $num;
    private string $date;
    private Client $client;
    private int $index;
    private float $contractAmount;
    private array $interventions;
    private static int $nbInterventions = 0;

    public function __construct(int $num, string $date, Client $client, int $index, float $contractAmount)
{
    $this->num = $num;
    $this->date = $date;
    $this->client = $client;
    $this->index = $index;
    $this->contractAmount = $contractAmount;
    $this->interventions = [];
}

    public function amount(): float
{
    return $this->contractAmount;
}

    public function difference(): float
{
    return $this->contractAmount - $this->client->getNbKm();
}

    public function addIntervention(Intervention $intervention)
{
    $this->interventions[] = $intervention;
    self::$nbInterventions++;
}

    public function getNum(): int
{
    return $this->num;
}

    public function getDate(): string
{
    return $this->date;
}

    public function getClient(): Client
{
    return $this->client;
}

    public function getIndex(): int
{
    return $this->index;
}

    public function getInterventions(): array
{
    return $this->interventions;
}

    public static function getNbInterventions(): int
{
    return self::$nbInterventions;
}
}

?>