<?php

namespace sem2\4;

use sem2\use sem2\use sem2\use sem2\use sem2\use sem2\class Participant
{
    private
    string $name;
    private string $surname;
    private int $oldest;
    private Session $actualSession;
    private array $choices;

    public function __construct(string $name, string $surname, int $oldest, Session $actualSession)
{
    $this->name = $name;
    $this->surname = $surname;
    $this->oldest = $oldest;
    $this->actualSession = $actualSession;
    $this->choices = [];
}

    public function addSession(Session $session): void
{
    if (!$session->isFull()) {
        $this->choices[] = $session;
        echo "Session ajoutée avec succès ! \n";
    } else {
        echo "Session pleine ! \n";
    }
}

    public function getSessionChoice(int $id): Session
{
    return $this->choices[$id];
}

    public function getActualSession(): Session
{
    return $this->actualSession;
}

    public function getChoices(): array
{
    return $this->choices;
}

    public function setSession(Session $session)
{
    $this->actualSession = $session;
}

    public function getName(): string
{
    return $this->name;
}

    public function getSurname(): string
{
    return $this->surname;
}

    public function getOldest(): int
{
    return $this->oldest;
}
}
?>