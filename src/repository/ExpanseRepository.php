<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Expanse.php';

class ExpanseRepository extends Repository {

    public function getExpanses() {
        $stmt = $this->database->connect()->prepare('
        SELECT e.id, e.name, e.amount, u.name as paid_by, e.group_id FROM public.expanses e left join public.users u on e.paid_by = u.id
        ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Expanse');
    }

    public function getExpansesByGroup(int $id) {
        $stmt = $this->database->connect()->prepare('
        SELECT e.id, e.name, e.amount, u.name as paid_by, e.group_id FROM public.expanses e left join public.users u on e.paid_by = u.id where e.group_id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Expanse');
    }

    public function getExpanse(int $id) {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.expanses WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_CLASS, 'Expanse');
    }

    public function saveExpanse($data) {
        $stmt = $this->database->connect()->prepare("
            INSERT INTO public.expanses (name, amount, paid_by, group_id) VALUES (?, ?, ?, ?);
        ");

        $stmt->execute([
            $data["name"],
            $data["amount"],
            $data["paidby"],
            $data["groupId"]
        ]);
        return;
    }

    public function getExpansebyName(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM expanses WHERE LOWER(name) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $stmt->fetch(PDO::FETCH_CLASS, 'Project');
    }
}