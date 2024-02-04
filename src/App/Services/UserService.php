<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
    public function __construct(private Database $db)
    {
    }

    public function isEmailTaken(string $email)
    {

        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email = :email",
            [
                'email' => $email
            ]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => ["Email Taken"]]);
        }
    }

    public function create(array $formdata)
    {
        $password = password_hash($formdata['password'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->db->query(
            "INSERT INTO users(name,email,password,age,country,social_media_url)
            VALUES(:name,:email,:password,:age,:country,:social_media_url)",
            [
                'name' => $formdata['name'],
                'email' => $formdata['email'],
                'password' => $password,
                'age' => $formdata['age'],
                'country' => $formdata['country'],
                'social_media_url' => $formdata['socialMediaURL']
            ]
        );

        session_regenerate_id();

        $_SESSION['user'] = $this->db->id();
    }

    public function login($formData)
    {

        $user = $this->db->query(
            "SELECT * FROM users WHERE email= :email",
            [
                'email' => $formData['email']
            ]
        )->find();

        $matchPassword = password_verify($formData['password'], $user['password'] ?? '');

        if (!$user || !$matchPassword) {
            throw new ValidationException(['password' => ['Invalid Credential']]);
        }

        session_regenerate_id();

        $_SESSION['user'] = $user['id'];
    }

    public function logout()
    {
        // unset($_SESSION['user']);
        session_destroy();

        $params = session_get_cookie_params();
        setcookie(
            "PHPSESSID",
            "",
            time() - 3600,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly'],
        );

        session_regenerate_id();
    }
}
