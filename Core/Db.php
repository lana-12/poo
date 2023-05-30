<?php

namespace App\Core;

use PDO;
use PDOException;

/**
 * Class avec le designPattern => Singleton:
 * Avec constructor private et une methode static pour instancier une seule fois
 */
class Db extends PDO
{
    // Instance unique de la class
    private static $instance;

    // Info de connexion
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = '';
    private const DBNAME = 'poo';


    // Constructor private
    private function __construct()
    {
        // DSN de connexion
        $dsn = 'mysql:dbname='. self::DBNAME.';host='. self::DBHOST;

        //on appel le constructeur de la class pdo
        try{
            parent::__construct($dsn, self::DBUSER, self::DBPASS);

        // On passe des attributs
        $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

        } catch(PDOException $e){
            die($e->getMessage());
        }
    
    }

    // Méthode qui vérifie si une instance existe sinon il l'a crée 
    // On peut mettre :PDO, SELF, DB
    public static function getInstance(): PDO
    {
        //Vérifie si instance = null
        if(self::$instance === null){
            //Si Null création de l'instance de la class
            self::$instance = new self();
        }
        //sinon return instance elle-même
        return self::$instance;
    }
}