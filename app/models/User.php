<?php

namespace App\Models;

use Core\ModelEntity;

/**
 * Entité représentant un utilisateur.
 * Avec les champs id, nom, email, mot de passe et date d'inscription.
 */

class User extends ModelEntity
{
    private string $username;
    private string $email;
    private string $password;
    private \DateTime $createdAt;

    /**
     * Retourne le nom de l'utilisateur.
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Définit le nom de l'utilisateur.
     * @param string $username
     * @return self
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Retourne l'email de l'utilisateur.
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Définit l'email de l'utilisateur.
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Retourne le mot de passe de l'utilisateur.
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Définit le mot de passe de l'utilisateur.
     * @param string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Retourne la date d'inscription de l'utilisateur.
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * Définit la date d'inscription de l'utilisateur.
     * @param \DateTime $createdAt
     * @return self
     */
    public function setCreatedAt(\DateTime|string $createdAt): self
    {
        if (is_string($createdAt)) {
            $createdAt = new \DateTime($createdAt);
        }

        $this->createdAt = $createdAt;
        return $this;
    }

}

