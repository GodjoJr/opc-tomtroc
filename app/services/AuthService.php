<?php

namespace App\Services;

use App\Models\User;
use App\Models\UsersManager;
use Core\Error;


class AuthService
{
    /**
     * Register a new user in the database.
     *
     * @param array $data The array of data to register the user.
     *                     The array must contain the keys 'username', 'email', and 'password'.
     *                     The values of these keys must be strings.
     *                     The 'username' key must have a value with a length of at least 2 characters.
     *                     The 'email' key must have a value that is a valid email address.
     *                     The 'password' key must have a value with a length of at least 4 characters.
     * @return array An array containing a boolean key 'success' and a key 'errors' that contains an array of error messages.
     *               If 'success' is false, then 'errors' will contain an array of error messages.
     *               If 'success' is true, then 'errors' will be an empty array.
     */
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
            ->setAvatar('/images/default-avatar.png')
            ->setCreatedAt(new \DateTime());

        $userManager->createUser($user);

        return ['success' => true];
    }

    /**
     * Login an existing user.
     *
     * @param array $data The array of data to login the user.
     *                    The array must contain the keys 'email' and 'password'.
     *                    The values of these keys must be strings.
     *                    The 'email' key must have a value that is a valid email address.
     *                    The 'password' key must have a value with a length of at least 4 characters.
     * @return array An array containing a boolean key 'success' and a key 'errors' that contains an array of error messages.
     *               If 'success' is false, then 'errors' will contain an array of error messages.
     *               If 'success' is true, then 'errors' will be an empty array.
     */
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
            'created_at' => $user->getCreatedAt(),
            'avatar' => $user->getAvatar(),
            'account_age' => $user->accountAge()
        ];

        return ['success' => true];
    }

}

