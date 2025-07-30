<?php

namespace App\Services;

use App\Models\User;
use App\Models\UsersManager;
use Core\Error;

class DashboardService
{
    function modifyAvatar($avatar)
    {
        $errors = [];

        if (empty($avatar)) {
            $errors['avatar'][] = "Une image de profil est requise.";
        }

        $user = new User();
        $user->setId($_SESSION['user']['id']);
        $user->setAvatar($avatar);

        $userManager = new UsersManager();
        $userManager->modifyAvatar($user);

        return ['success' => true, 'errors' => $errors];
    }

    function modifyUser($data)
    {
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $username = $data['username'] ?? null;
        
        $errors = [];

        if (empty($email)) {
            $errors['email'][] = "Une adresse email est requise.";
        }

        if (empty($username)) {
            $errors['username'][] = "Un nom d'utilisateur est requis.";
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