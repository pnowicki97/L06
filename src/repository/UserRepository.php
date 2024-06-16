<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository {

    public function getUsers() {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users
        ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public function getUsersByGroup(int $id) {
        $stmt = $this->database->connect()->prepare('
            SELECT u.* FROM public.users u left join users_groups ug on u.id = ug.user_id
	        where ug.group_id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public function getUser(int $id) {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_CLASS, 'User');
    }

    public function saveUser($data) {
        $stmt = $this->database->connect()->prepare("
            INSERT INTO public.users (name, password, \"photo_url\") VALUES (?, ?, ?);
        ");

        $stmt->execute([
            $data["username"],
            $data["password"],
            $data["photoUrl"],
        ]);
        return;
    }

    public function getUserbyName(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users WHERE LOWER(name) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}