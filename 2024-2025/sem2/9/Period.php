<?php

namespace sem2\9;

use sem2\use sem2\class Period
{
    private
    DateTime $date;
    private int $tranche;

    public function __construct(DateTime $date, int $tranche)
{
    $this->date = $date;
    $this->tranche = $tranche;
}

    public function statue(FireFighter $fireFighter): string
{
    return $fireFighter->statue($this);
}

    public function commission(FireFighter $fireFighter): void
{
    $fireFighter->commission($this);
}

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
{
    return $this->date;
}

    /**
     * @return int
     */
    public function getTranche(): int
{
    return $this->tranche;
}
}