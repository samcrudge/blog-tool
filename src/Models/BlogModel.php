<?php

namespace App\Models;

class BlogModel
{
    private $db;

    /**
     * BlogModel constructor.
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
        return $blogPost;
    }

    public function createNewEntry($blogpost): bool
    {
        $query = $this->db->prepare("INSERT INTO `blog-posts` (`title`, `author`, `date`, `post`) VALUE (:title, :author, :date, :post)");
        $addNewEntry = $query->execute($blogpost);
        return $addNewEntry;
    }

    public function editEntry($editedEntry): bool
    {
        $query = $this->db->prepare("SELECT `title` FROM `blog-posts` UPDATE (:title, :Date, :post)");
        $updatedEntry = $query->execute($editedEntry);
        return $updatedEntry;
    }

    public function removeEntry($removeEntry)
    {
        $query = $this->db->prepare("SELECT `title` FROM `blog-posts` UPDATE (:deleted)");
        $deletedEntry = $query->execute($removeEntry);
        return $deletedEntry;
    }
}
