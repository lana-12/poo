<?php

namespace App\Models;

use App\Core\Db;
use App\Functions\Method;

class Model extends Db
{
    //Table de la BDD
    protected $table;

    // Instance de Db
    private $db;


    /**
     * READ 
     * Récupère les enregistrement de la table
     * @return void
     */
    public function findAll()
    {
        $query = $this->myQuery('SELECT * FROM '. $this->table);
        return $query->fetchAll();
    }

    public function findBy(array $criteres)
    {
        $champs = [];
        $values = [];

        // Boucler pour éclater le array
        foreach ($criteres as $key => $value) {
            // SELECT * FROM posts where actif = ?
            //bindValue(1, valeur)
            $champs[] = "$key = ?";
            $values[] = $value;
            
        }
        // Method::dump($champs);
        // Method::dump($values);

        // Transformer Array Champs en string séparé par des AND
        $listKeys = implode(' AND ', $champs);
        // Method::dump($listKeys);
        
        // Maintenant les champs sont séparer par des AND
        // Exécute la request
        return $this->myQuery('SELECT * FROM '.$this->table . ' WHERE '. $listKeys, $values)->fetchAll();
    }

    public function find(int $id)
    {
        return $this->myQuery("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

/**
 * Create in BDD
 *
 * @param Model $model
 * @return void
 */
    public function create(Model $model)
    {
        $champs = [];
        $inter = [];
        $values = [];

        // Boucler pour éclater le array
        foreach ($model as $key => $value) {
            // INSERT INTO posts(title, content, active) VALUES (?,?,?)
            
            if($key !== null && $key !== 'db' && $key !== 'table' && $key !== 'created_at'){
                $champs[] = $key;
                $inter[] = "?";
                $values[] = $value;
            }
        }
        // Method::dump($champs);
        // Method::dump($values);

        // Transformer Array Champs en string séparé par des ,
        // Maintenant les champs sont séparer par des ,
        $listKeys = implode(', ', $champs);
        $listInter = implode(', ', $inter);

        // echo $listKeys; die($listInter);

        // Exécute la request
        return $this->myQuery('INSERT INTO ' . $this->table . ' (' . $listKeys . ') VALUE ('. $listInter.')', $values);
    }

    public function update(int $id, Model $model)
    {
        $champs = [];
        $values = [];

        // Boucler pour éclater le array
        foreach ($model as $key => $value) {
            // UPDATE posts SET title = ? , content = ?, active = ? WHERE id = ?;

            if ($key !== null && $key !== 'db' && $key !== 'table' && $key !== 'created_at') {
                $champs[] = "$key = ?";
                $values[] = $value;
            }
        }
        $values[] = $id;
        // Method::dump($champs[0]);
        // Method::dump($values);

        // Transformer Array Champs en string séparé par des ,
        // Maintenant les champs sont séparer par des ,
        $listKeys = implode(', ', $champs);

        // // Exécute la request
        return $this->myQuery('UPDATE ' . $this->table . ' SET ' . $listKeys . ' WHERE id = ?', $values);
    }

    public function delete(int $id)
    {
        return $this->myQuery('DELETE FROM '. $this->table . ' where id = ? ', [$id]);
    }

    public function myQuery(string $sql, array $attributs=null)
    {
        //Récupérer l'instance de DB
        $this->db = Db::getInstance();

        //Verification si on a des attributs
        if($attributs !== null){
            // Request préparée
            $query = $this->db->prepare($sql);
            //Comme on ne sait pas exactement ce qu'on récupère on ne peut pas faire des bindValue donc ds execute(passe le array $attributs)
            $query->execute($attributs);
            return $query;

        }else{
            // Request simple
            return $this->db->query($sql);
        }
    }

    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value) {
            //Récupère le nom du setter correspondant à la clé
            //title ->setTitle 
            $setter = 'set'. ucfirst($key);

            //Verification di le setter existe
            if(method_exists($this, $setter)){
                //Appelle le setter
                $this->$setter($value);
            }
        }
        return $this;
    }
}