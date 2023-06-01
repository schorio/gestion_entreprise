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
        $this->pass = "";
        $this->dbname = "ven_sto";
        $this->table = "administrateur";
    }

    /**
     * implementation de la methode abstraite hydrate
     * @param $donnees
     * @return self
     */
    public function hydrate($donnees): self
    {
        foreach ($donnees as $key => $value)
        {
            // ucfirst : make fist caracter of the string uppercase
            $setter = 'set'.ucfirst($key);

            if (method_exists($this, $setter))
            {
                $this->$setter($value);
            }
        }
        return $this;
    }

    /**
     * fonction qui verifie la connexion
     * @param string $email
     * @return mixed
     */
    public function findOneByEmail(string $email): mixed
    {
        return $this->request("SELECT * FROM ".$this->table." WHERE email LIKE '". $email ."'")->fetch();
    }

    /**
     * Creation de la session de l'administrateur
     */
    public function setSession()
    {
        $_SESSION["admin"] = [
            "id" => $this->id,
            "email" => $this->email
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
}