<?php 

namespace App\Core;

use PDO;
use PDOException;

/**
 * Cette classe se charge de la connexion à la base de données
 */
class Connexion extends PDO
{
    /**
     * instance du class connexion
     *
     * @var self
     */
    private static $instance;

    private const HOST = "localhost";

    /**
     * constructeur
     */
    public function __construct(string $user, string $password, string $dbname)
    {
        $dsn = 'mysql:dbname=' . $dbname . ';host=' . self::HOST;

        try {
            parent::__construct($dsn, $user, $password);

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    /**
     * get the instance of this class
     *
     * @return self
     */
    public static function getInstance(string $user, string $password, string $dbname): self
    {
        if(self::$instance === null) {
            self::$instance = new self($user, $password, $dbname);
        }
        return self::$instance;
    }

}