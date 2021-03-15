<?php

namespace App\Models;

use App\Interfaces\BlogModelInterface;

class BlogModel implements BlogModelInterface
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

    public function CreateNewEntry($blogPost): bool
    {
        $query = $this->db->prepare('INSERT INTO `blog-posts` (`title`, `author`, `date`, `post`)
                                        VALUES (:title , :author, :date, :post)');
        return $queryCheck = $query->execute($blogPost);
    }

    public function ReadAllEntries(): array
    {
        $query = $this->db->query('SELECT `title`, `author`, `date`, `post`, `GUID`
                                    FROM `blog-posts` 
                                    WHERE `deleted` = 0;');
         return $query = $query->fetchAll();
    }

    public function UpdateEntry($editEntry): bool
    {
        $query = $this->db->prepare('UPDATE `blog-posts`
                                        set `title` = :title,
                                            `date` = :date,
                                            `post` = :post 
                                        WHERE `GUID` = :GUID;');
        return $updatedEntry = $query->execute($editEntry);
    }

    public function DeleteEntry($deleteEntry): bool
    {
        $query = $this->db->prepare('UPDATE `blog-posts`
                                        set `deleted` = 1 
                                        WHERE `GUID` = :GUID;');
        return $deleteEntry = $query->execute($deleteEntry);
    }
}
