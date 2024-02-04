<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class EmployeService
{
    public function __construct(private Database $db)
    {
    }

    public function getEmployes(int $length, int $offset)
    {
        $name = addcslashes($_GET['s'] ?? '', '$_-');
        $searchTerm = "%{$name}%";

        $employes = $this->db->query(
            "SELECT * FROM users
            WHERE name LIKE :name
            LIMIT $length OFFSET $offset",
            [
                'name' => $searchTerm
            ]
        )->findAll();

        $employeCount = $this->db->query(
            "SELECT COUNT(*) FROM users
            WHERE name LIKE :name",
            [
                'name' => $searchTerm
            ]
        )->count();

        return [$employes, $employeCount];
    }

    public function getEmploye(string $id)
    {
        $employe = $this->db->query(
            "SELECT * FROM users WHERE id = :id",
            [
                'id' => $id
            ]
        )->find();

        return $employe;
    }

    public function update(array $formData, string $id)
    {

        $this->db->query(
            "UPDATE users
            SET name = :name, 
            email = :email,
            age = :age, 
            country = :country, 
            social_media_url = :social_media_url
            WHERE id = :id",
            [
                'name' => $formData['name'],
                'email' => $formData['email'],
                'age' => $formData['age'],
                'country' => $formData['country'],
                'social_media_url' => $formData['socialMediaURL'],
                'id' => $id
            ]
        );
    }

    public function delete(string $id)
    {

        $this->db->query(
            "DELETE FROM users WHERE id = :id",
            [
                'id' => $id
            ]
        );
    }
}
