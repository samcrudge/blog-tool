<?php

set XDEBUG_SESSION=1
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
        $query = $this->db->query("SELECT `title`, `author`, `date`, `post`, `GUID`
                                    FROM `blog-posts` 
                                    WHERE `deleted` = 0;");
         return $query = $query->fetchAll();

    }


    public function CreateNewEntry($blogPost, $db): bool
    {
        $query = $db->prepare("INSERT INTO `blog-posts` (`title`, `author`, `date`, `post`) 
                                        VALUE (:title, :author, :date, :post)");
        $addNewEntry = $query->execute([
            ":title" => $blogPost["title"],
            ":author" => $blogPost["author"],
            ":date" => $blogPost["date"],
            ":post" => $blogPost["post"]
            ]);
        return $addNewEntry;
    }


    public function EditEntry($editEntry): bool
    {
        $query = $this->db->prepare("SELECT `GUID` FROM `blog-posts` 
                                        UPDATE (:title, :Date, :post)");
        $updatedEntry = $query->execute($editEntry);
        return $updatedEntry;
    }

    /**
     * @return bool
     * Collects selected Post via `GUID` and soft deletes.
     * Uses Prepare to avoid Mysql Injection.
     */
    public function DeleteEntry($deleteEntry): bool
    {
        $query = $this->db->prepare("SELECT `GUID` FROM `blog-posts` UPDATE (:deleted)");
        $deletedEntry = $query->execute($deleteEntry);
        return $deletedEntry;
    }
}
