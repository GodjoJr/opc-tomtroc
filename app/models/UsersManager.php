<?php
namespace App\Models;

use App\Models\User;
use Core\ModelManager;
use Core\Error;


class UsersManager extends ModelManager
{

    /**
     * Creates a user.
     * @param User $user : the user to create.
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
     * Finds a user by its email.
     * @param string $email : the email of the user to find.
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
     * Finds a user by its id.
     *
     * @param int $id
     * @return User | null
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
        return null;
    }

    /**
     * Finds a user by its username.
     * @param string $username : the username of the user to find.
     * @return User | Error
     */
    public function findUserByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE u_username = :username";
        $result = $this->db->query($sql, [
            'username' => $username,
        ]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return new Error("The user does not exist.");
    }

    /**
     * Modifies a user.
     * @param User $user : the user to modify.
     */
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

    /**
     * Modifies a user's avatar.
     * @param User $user : the user to modify.
     */
    public function modifyAvatar(User $user)
    {
        $sql = "UPDATE users SET u_avatar = :avatar WHERE u_id = :id";
        $this->db->query($sql, [
            'avatar' => $user->getAvatar(),
            'id' => $user->getId(),
        ]);
    }
}

