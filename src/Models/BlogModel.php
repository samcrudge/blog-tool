<?php

namespace App\Models;

class BlogModel
{
    private $db;

    /**
     * blogModel constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function GetAllEntries(): array
    {
        $query = $this->db->query('SELECT `title`, `author`, `date`, `post`, `GUID`
                                    FROM `blog-posts` 
                                    WHERE `deleted` = 0;');
         return $query = $query->fetchAll();

    }


    public function CreateNewEntry($blogPost): bool
    {
        $query = $this->db->prepare('INSERT INTO `blog-posts` (`title`, `author`, `date`, `post`)
                                        VALUES (:title , :author, :date, :post)');
        $queryCheck = $query->execute($blogPost);
        return $queryCheck;
    }


    public function EditEntry($editEntry): bool
    {
        $query = $this->db->prepare('UPDATE `blog-posts`
                                        set `title` = :title, `date` = :date, `post` = post 
                                        WHERE `GUID` = :GUID;');
        $updatedEntry = $query->execute($editEntry);
        return $updatedEntry;
    }


    public function DeleteEntry($deleteEntry): bool
    {
        $query = $this->db->prepare('SELECT `GUID` FROM `blog-posts` UPDATE (:deleted)');
        $deletedEntry = $query->execute($deleteEntry);
        return $deletedEntry;
    }
}
