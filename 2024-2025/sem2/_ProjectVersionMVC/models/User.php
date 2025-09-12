<?php

/*
 * Cette classe facilite la création d'un utilisateur
 *
 * Un utilisateur contient :
 * - Un nom d'utilisateur
 * - Un mot de passe
 * - Un email
 * - Un numéro de téléphone
 */

namespace sem2\_ProjectVersionMVC\models;
class User
{
    private string $username;
    private string $password;
    private string $email;
    private string $telephone;

    public function __construct(string $username, string $password, string $email, string $telephone)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }
}

?>