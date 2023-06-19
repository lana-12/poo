<?php
namespace App\Models;

use DateTime;

//Pas besoin du use car même namespace
class PostsModel extends Model
{
    protected int $id;
    protected string $title;
    protected string $content;
    protected $created_at;
    protected bool $active;
    protected $users_id;
    protected $likes;
    protected $like_count;
    protected $dislike_count;


    
    public function __construct()
    {
        $this->table = 'posts';
        // $this->created_at = new DateTime();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of active
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of users_id
     */
    public function getUsers_id(): int
    {
        return $this->users_id;
    }

    /**
     * Set the value of users_id
     *
     * @return  self
     */
    public function setUser_id(int $users_id)
    {
        $this->users_id = $users_id;

        return $this;
    }


    /**
     * Get the value of likes
     */ 
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set the value of likes
     *
     * @return  self
     */ 
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get the value of likeCount
     */ 
    public function getLikeCount()
    {
        return $this->like_count;
    }

    /**
     * Set the value of likeCount
     *
     * @return  self
     */ 
    public function setLikeCount($like_count)
    {
        $this->like_count = $like_count;

        return $this;
    }

    /**
     * Get the value of dislikeCount
     */ 
    public function getDislikeCount()
    {
        return $this->dislike_count;
    }

    /**
     * Set the value of dislikeCount
     *
     * @return  self
     */ 
    public function setDislikeCount($dislike_count)
    {
        $this->dislike_count = $dislike_count;

        return $this;
    }
}

