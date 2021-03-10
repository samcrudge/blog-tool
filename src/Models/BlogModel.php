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

    public function GetAllEntries(): bool
    {
        $query = $this->db->prepare("SELECT `*` FROM `blog-posts` WHERE deleted=0");
        $query->execute();
        $Blog = $query->fetchAll();
        return $Blog;
    }

    public function CreateNewEntry($BlogPost): bool
    {
        $query = $this->db->prepare("INSERT INTO `blog-posts` (`title`, `author`, `date`, `post`) VALUE (:title, :author, :date, :post, :GUID)");
        $AddNewEntry = $query->execute($BlogPost);
        return $AddNewEntry;
    }

    public function EditEntry($EditEntry): bool
    {
        $query = $this->db->prepare("SELECT `GUID` FROM `blog-posts` UPDATE (:title, :Date, :post)");
        $UpdatedEntry = $query->execute($EditEntry);
        return $UpdatedEntry;
    }

    public function DeleteEntry($DeleteEntry)
    {
        $query = $this->db->prepare("SELECT `GUID` FROM `blog-posts` UPDATE (:deleted)");
        $DeletedEntry = $query->execute($DeleteEntry);
        return $DeletedEntry;
    }
}
