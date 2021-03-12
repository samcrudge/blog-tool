<?php

namespace App\Entities;

class PostEntitys
{
    private $title;
    private $author;
    private $date;
    private $post;

    /**
     * PostEntitys constructor.
     * @param $title
     * @param $author
     * @param $date
     * @param $post
     */
    public function __construct($title, $author, $date, $post)
    {
        $this->title = $title;
        $this->author = $author;
        $this->date = $date;
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

}
