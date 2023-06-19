<?php

namespace App\Models;

class PostLikesModel extends Model
{
    protected int $id;
    protected $created_at;
    protected int $user;
    protected int $post;

    


    public function __construct()
    {
        $this->table = 'post_likes';
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
     * Get the value of user
     */ 
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of post
     */ 
    public function getPost(): int
    {
        return $this->post;
    }

    /**
     * Set the value of post
     *
     * @return  self
     */ 
    public function setPost($post): self
    {
        $this->post = $post;

        return $this;
    }
}