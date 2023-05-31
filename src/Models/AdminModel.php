<?php

namespace App\Models;

use App\Core\Model;

/**
 * administrateur model
 */
class AdminModel extends Model
{
    private int $id;

    private string $email;
     
    private string $password;

    /**
     * init
     */
    public function __construct(){
        $this->user = "root";
        $this->pass = "Rhjaforlife123##";
        $this->dbname = "ven_sto";
        $this->table = "administrateur";
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
}