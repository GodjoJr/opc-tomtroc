<?php

namespace App\Services;

use App\Models\User;
use App\Models\UsersManager;
use Core\Error;


class DashboardService
{
    /**
     * Modifies the user's avatar.
     * 
     * @param string $avatar The new avatar.
     * @return array An array containing a boolean key 'success' and a key 'errors' that contains an array of error messages.
     */
    public function modifyAvatar(string $avatar): array
    {
        $errors = [];

        if (empty($avatar)) {
            $errors['avatar'][] = "An avatar is required.";
        }

        $user = new User();
        $user->setId($_SESSION['user']['id']);
        $user->setAvatar($avatar);

        $userManager = new UsersManager();
        $userManager->modifyAvatar($user);

        return ['success' => true, 'errors' => $errors];
    }

    /**
     * Modifies the user's informations.
     * 
     * @param array $data The array of data to modify the user.
     *                    The array must contain the keys 'email', 'password', and 'username'.
     *                    The values of these keys must be strings.
     * @return array An array containing a boolean key 'success' and a key 'errors' that contains an array of error messages.
     */
    public function modifyUser(array $data): array
    {
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $username = $data['username'] ?? null;
        
        $errors = [];

        if (empty($email)) {
            $errors['email'][] = "An email is required.";
        }

        if (empty($username)) {
            $errors['username'][] = "A username is required.";
        }

        $userManager = new UsersManager();
        $user = $userManager->findUserById($_SESSION['user']['id']);

        if ($user->getEmail() !== $email) {
            $user->setEmail($email);
        }

        if ($user->getUsername() !== $username) {
            $user->setUsername($username);
        }

        if (!empty($password)) {
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        }

        $userManager->modifyUser($user);

        return ['success' => true, 'errors' => $errors];

    }
}
