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

    public function createNewEntry($newBlogPost): bool
    {
        $query = $this->db->prepare('INSERT INTO `blog-posts` (`title`, `author`, `date`, `post`)
                                        VALUES (:title , :author, :date, :post)');
        return $query->execute($newBlogPost);
    }

    public function readAllEntries(): array
    {
        $query = $this->db->query('SELECT `title`, `author`, `date`, `post`, `GUID`
                                    FROM `blog-posts` 
                                    WHERE `deleted` = 0;');
         return $query->fetchAll();
    }

    public function updateEntry($updatedBlogPostData): bool
    {
        $query = $this->db->prepare('UPDATE `blog-posts`
                                        set `title` = :title,
                                            `date` = :date,
                                            `post` = :post 
                                        WHERE `GUID` = :GUID;');
        return $query->execute($updatedBlogPostData);
    }

    public function deleteEntry($guid): bool
    {
        $query = $this->db->prepare('UPDATE `blog-posts`
                                        set `deleted` = 1 
                                        WHERE `GUID` = :GUID;');
        return $query->execute($guid);
    }
}
