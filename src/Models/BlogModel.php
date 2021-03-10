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


    /**
     * @return bool
     * collect all fields where not deleted.
     */
    public function GetAllEntries(): bool
    {
        $query = $this->db->prepare("SELECT `*` FROM `blog-posts` WHERE deleted=0");
        $query->execute();
        $Blog = $query->fetchAll();
        return $Blog;
    }

    /**
     * @return bool
     * Creates a new post with Prepare to avoid Mysql injection.
     */
    public function CreateNewEntry($BlogPost): bool
    {
        $query = $this->db->prepare("INSERT INTO `blog-posts` (`title`, `author`, `date`, `post`) VALUE (:title, :author, :date, :post, :GUID)");
        $AddNewEntry = $query->execute($BlogPost);
        return $AddNewEntry;
    }

    /**
     * @return bool
     * Collects selected Post via `GUID` and allows update to `Title` & `Post`.
     * Uses Prepare to avoid Mysql Injection.
     */
    public function EditEntry($EditEntry): bool
    {
        $query = $this->db->prepare("SELECT `GUID` FROM `blog-posts` UPDATE (:title, :Date, :post)");
        $UpdatedEntry = $query->execute($EditEntry);
        return $UpdatedEntry;
    }

    /**
     * @return bool
     * Collects selected Post via `GUID` and soft deletes.
     * Uses Prepare to avoid Mysql Injection.
     */
    public function DeleteEntry($DeleteEntry)
    {
        $query = $this->db->prepare("SELECT `GUID` FROM `blog-posts` UPDATE (:deleted)");
        $DeletedEntry = $query->execute($DeleteEntry);
        return $DeletedEntry;
    }
}
