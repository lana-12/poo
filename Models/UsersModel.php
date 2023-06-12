<?php

namespace App\Models;

class UsersModel extends Model
{
    protected int $id;
    protected string $email;
    protected string $password;
    protected $created_at;
    protected $roles;

    public function __construct()
    {

        $class = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        $this->table = strtolower(str_replace('Model', '',$class));
    }

    /**
     * Récupérer User à partir du email
     *
     * @param string $email
     * @return void
     */
    public function findOneByEmail(string $email)
    {
        return $this->myQuery('SELECT * FROM '.$this->table . ' WHERE email = ?', [$email])->fetch();
    }

    /**
     * Create session user
     *
     * @return void
     */
    public function setSession()
    {
        $_SESSION['user'] =[
            'id' => $this->id,
            'email'=> $this->email,
            'roles'=> $this->roles
        ];

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
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

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
     * Get the value of roles
     */ 
    public function getRoles(): array
    {
        $roles = $this->roles;
        //Si user n'a pas de role meme si ds la BDD = null
        $roles[]= 'ROLE_USER';

        return array_unique($roles);
    
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */ 
    public function setRoles($roles): self
    {
        $this->roles = json_decode($roles);

        return $this;
    }
}

