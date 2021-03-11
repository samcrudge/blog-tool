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

    public function GetAllEntries()
    {
        $query = $this->db->query("SELECT `*` FROM `blog-posts` WHERE `deleted` = 0;");
         return $query = $query->fetchAll();

    }

    /**
     * @return bool
     * Creates a new post with Prepare to avoid Mysql injection.
     */
    public function CreateNewEntry($BlogPost): bool
    {
        $query = $this->db->prepare("INSERT INTO `blog-posts` (`title`, `author`, `date`, `post`) VALUE (:title, :author, :date, :post, :GUID)");
        $addNewEntry = $query->execute($BlogPost);
        return $addNewEntry;
    }

    /**
     * @return bool
     * Collects selected Post via `GUID` and allows update to `Title` & `Post`.
     * Uses Prepare to avoid Mysql Injection.
     */
    public function EditEntry($EditEntry): bool
    {
        $query = $this->db->prepare("SELECT `GUID` FROM `blog-posts` UPDATE (:title, :Date, :post)");
        $updatedEntry = $query->execute($EditEntry);
        return $updatedEntry;
    }

    /**
     * @return bool
     * Collects selected Post via `GUID` and soft deletes.
     * Uses Prepare to avoid Mysql Injection.
     */
    public function DeleteEntry($deleteEntry)
    {
        $query = $this->db->prepare("SELECT `GUID` FROM `blog-posts` UPDATE (:deleted)");
        $deletedEntry = $query->execute($deleteEntry);
        return $deletedEntry;
    }
}
