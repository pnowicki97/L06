<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Group.php';

class GroupRepository extends Repository {

    public function getGroups() {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.groups
        ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Group');
    }

    public function getGroupsByUser($id) {
        $stmt = $this->database->connect()->prepare('
        select g.* from public.groups g left join public.users_groups gu on g.id = gu.group_id where gu.user_id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Group');
    }

    public function getGroup(int $id) {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.groups WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_CLASS, 'Group');
    }

    public function getGroupById(int $id) {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.groups WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Group');
    }

    public function saveGroup($data) {

        $stmt = $this->database->connect()->prepare('
        SELECT id FROM public.groups ORDER BY id DESC LIMIT 1;
        ');
        $stmt->execute();
        $id = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->database->connect()->prepare("
            INSERT INTO public.groups (name, \"photo_url\") VALUES (?, ?);
        ");

        $stmt->execute([
            $data["name"],
            $data["photoUrl"],
        ]);

        if(empty($data["checkbox"])):
            return;
        endif;    
        $stmt = $this->database->connect()->prepare("
        INSERT INTO public.users_groups (user_id, group_id) VALUES (?, ?);
        ");

        foreach($data["checkbox"] as $user):
            $stmt->execute([
                $user,
                $id[0]["id"]
            ]);
        endforeach;
        return;
    }

    public function getGroupByName(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM groups WHERE LOWER(name) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $stmt->fetch(PDO::FETCH_CLASS, 'Project');
    }
}