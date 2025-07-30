<?php
namespace App\Models;

use App\Models\User;
use Core\ModelManager;
use Core\Error;
/** 
 * Classe qui gère les articles.
 */
class UsersManager extends ModelManager
{

    /**
     * Crée un utilisateur.
     * @param User $user : l'utilisateur à créer.
     */
    public function createUser(User $user)
    {

        $sql = "INSERT INTO users (u_username, u_email, u_password, u_avatar, u_created_at) VALUES (:username, :email, :password, :avatar, NOW())";
        $this->db->query($sql, [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'avatar' => $user->getAvatar(),
        ]);
    }

    /**
     * Recherche un utilisateur par son email.
     * @param string $email : l'email de l'utilisateur à chercher.
     * @return User|null
     */
    public function findUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE u_email = :email";
        $result = $this->db->query($sql, [
            'email' => $email,
        ]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;

    }

    /**
     * Recherche un utilisateur par son identifiant.
     *
     * @param int $id
     * @return User | Error
     */
    public function findUserById($id)
    {
        $sql = "SELECT * FROM users WHERE u_id = :id";
        $result = $this->db->query($sql, [
            'id' => $id,
        ]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return new Error("l'utilisateur n'existe pas.");
    }

    public function modifyUser(User $user)
    {
        $sql = "UPDATE users SET u_username = :username, u_email = :email, u_password = :password WHERE u_id = :id";
        $this->db->query($sql, [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'id' => $user->getId(),
        ]);
    }

    public function modifyAvatar(User $user)
    {
        $sql = "UPDATE users SET u_avatar = :avatar WHERE u_id = :id";
        $this->db->query($sql, [
            'avatar' => $user->getAvatar(),
            'id' => $user->getId(),
        ]);
        
    }
}

