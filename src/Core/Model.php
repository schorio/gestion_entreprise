<?php

namespace App\Core;

use App\Core\Connexion;

/**
 * Undocumented class
 */
abstract class Model extends Connexion
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $user;
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $pass;
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $dbname;
    /**
     * nom de la table
     *
     * @var string
     */
    protected string $table;
    /**
     * Undocumented variable
     *
     * @var Connexion
     */
    private Connexion $connexion;

    /**
     * exectution d'une requete
     *
     * @param string $sql
     * @param array|null $attributs
     */
    public function request(string $sql, array $attributs = null)
    {
        $this->connexion = Connexion::getInstance($this->user, $this->pass, $this->dbname);

        if($attributs !== null) {
            $query = $this->connexion->prepare($sql);
            $query->execute($attributs);
            return $query;
        }else{
            return $this->connexion->query($sql);
        }
    }

    /**
     * recuperer tous les lignes d'une tables
     *
     * @return array
     */
    public function findAll(): array
    {
        $query = $this->request('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    /**
     * recuperation des lignes d'une table selon des critères précis
     *
     * @param array $criteres
     * @return array
     */
    public function findBy(array $criteres): array
    {
        $champs = [];
        $valeurs = [];

        foreach ($criteres as $champ => $valeur) {
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }
        $liste_champs = implode(' AND ', $champs);

        return $this->request("SELECT * FROM " . $this->table . " WHERE " . $liste_champs, $valeurs)->fetchAll();
    }

    /**
     * recuperer une ligne par son identifiant
     *
     * @param integer $id
     * @return array
     */
    public function find(int $id): array
    {
        return $this->request("SELECT * FROM " . $this->table . " WHERE id = " . $id)->fetch();
    }

    public function create(Model $model)
    {
        $champs = [];
        $intermediaire = [];
        $valeurs = [];

        foreach ($model as $champ => $valeur) {
            if($valeur !== null && $champ != "db" && $champ != "table")
            {
                $champs[] = $champ;
                $intermediaire[] = "?";
                $valeurs[] = $valeur;
            }
        }
        $liste_champs = implode(',', $champs);
        $liste_intermediarire = implode(',', $intermediaire);
        return $this->
            request("INSERT INTO " . $this->table . " ( " . $liste_champs . ") VALUES (" . $liste_intermediarire . ")",
            $valeurs );
    }

    /**
     * fonction qui sert à hydrater un objet
     *
     * @param [type] $donnees
     * @return self
     */
    abstract function hydrate($donnees);

    public function update(int $id, Model $model)
    {
        $champs = [];
        $valeurs = [];

        foreach ($model as $champ => $valeur) {
            if($valeur !== null && $champ !== "db" && $champ !== "table")
            {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;

        $liste_champs = implode(',', $champs);

        return $this->request("UPDATE " . $this->table . " SET " . $liste_champs . " WHERE id = ?", $valeurs);
    }

    public function delete(int $id)
    {
        return $this->request("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }
}