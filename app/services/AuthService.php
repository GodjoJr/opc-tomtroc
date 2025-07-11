<?php

namespace App\Services;

use App\Models\User;
use App\Models\UsersManager;
use Core\Error;

class AuthService
{
    public function register(array $data): array
    {
        $errors = [];

        if (empty($data['username']) || strlen($data['username']) < 2) {
            $errors['username'][] = "Le nom d'utilisateur est requis et doit contenir au moins 2 caractères.";
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'][] = "Une adresse email valide est requise.";
        }

        if (empty($data['password']) || strlen($data['password']) < 4) {
            $errors['password'][] = "Le mot de passe est requis et doit contenir au moins 4 caractères.";
        }

        $userManager = new UsersManager();
        $existingUser = $userManager->findUserByEmail($data['email']);
        if ($existingUser !== null) {
            $errors['email'][] = "Un compte avec cet email existe déjà.";
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $user = (new User())
            ->setUsername(htmlspecialchars($data['username']))
            ->setEmail(htmlspecialchars($data['email']))
            ->setPassword(password_hash($data['password'], PASSWORD_DEFAULT))
            ->setCreatedAt(new \DateTime());

        $userManager->createUser($user);

        return ['success' => true];
    }


    public function login(array $data): array
    {
        $errors = [];

        if (empty($data['email'])) {
            $errors['email'][] = "L'email est requis.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'][] = "Format d'email invalide.";
        }

        if (empty($data['password'])) {
            $errors['password'][] = "Le mot de passe est requis.";
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $userManager = new UsersManager();
        $user = $userManager->findUserByEmail($data['email']);

        if ($user === null || !password_verify($data['password'], $user->getPassword())) {
            $errors['global'][] = "Identifiants incorrects.";
            return ['success' => false, 'errors' => $errors];
        }

        $_SESSION['user'] = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
        ];

        return ['success' => true];
    }

}
