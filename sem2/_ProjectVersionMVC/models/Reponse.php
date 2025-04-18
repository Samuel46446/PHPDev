<?php

/*
 * Permet de créer une réponse à un post
 *
 * Une réponse contient :
 * - Le texte de la réponse
 * - Le numéro du post auquel elle répond
 * - Le numéro de l'utilisateur qui a posté la réponse
 */
class Reponse
{
    private string $text;
    private int $pno;
    private int $uno;

    public function __construct(string $text, int $pno, int $uno)
    {
        $this->text = $text;
        $this->pno = $pno;
        $this->uno = $uno;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getPno(): int
    {
        return $this->pno;
    }

    public function getUno(): int
    {
        return $this->uno;
    }
}