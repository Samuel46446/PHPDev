<?php

/*
 * Composant de base pour les tutoriels
 *
 * Un composant contient :
 * - Un id de composant (cno)
 * - Une description
 * - Un code
 * - Un id de loader (lno)
 */
class Component
{
    private string $cno;
    private string $description;
    private string $code;
    private int $lno;

    public function __construct(string $cno, string $description, string $code, int $lno)
    {
        $this->cno = $cno;
        $this->description = $description;
        $this->code = $code;
        $this->lno = $lno;
    }

    /**
     * @return string
     */
    public function getCno(): string
    {
        return $this->cno;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getLno(): int
    {
        return $this->lno;
    }
}

?>