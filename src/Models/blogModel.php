<?php

namespace App\Models;

class blogModel
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

    public function getAllEntries(): bool
    {
        $query = $this->db->prepare("SELECT `*` FROM `blog-posts` WHERE deleted=0");
        $query->execute();
        $blog = $query->fetchAll();
        return $blog;
    }

    public function createNewEntry($blogPost): bool
    {
        $query = $this->db->prepare("INSERT INTO `blog-posts` (`title`, `author`, `date`, `post`) VALUE (:title, :author, :date, :post)");
        $addNewEntry = $query->execute($blogPost);
        return $addNewEntry;
    }

    public function editEntry($editEntry): bool
    {
        $query = $this->db->prepare("SELECT `title` FROM `blog-posts` UPDATE (:title, :Date, :post)");
        $updatedEntry = $query->execute($editEntry);
        return $updatedEntry;
    }

    public function deleteEntry($deleteEntry)
    {
        $query = $this->db->prepare("SELECT `title` FROM `blog-posts` UPDATE (:deleted)");
        $deletedEntry = $query->execute($removeEntry);
        return $deletedEntry;
    }
}
