<?php
/**
 * Compte Bancaire
 */
class Compte 
{
    public string $titulaire;
    public float $solde;


    public function __construct(string $name, float $montant=100)
    {
        $this->titulaire = $name;
        $this->solde = $montant;
    }

    public function deposer(float $montant)
    {
        //Vérifier si montant est positif 
        if($montant > 0){
            $this->solde += $montant;
        }
    }

    public function voirSolde()
    {
        //Sinon faire un return et intégrer ds html
        echo "Le solde du compte est de $this->solde euros";
    }

    public function retirer(float $montant)
    {
        //Vérifier si montant est positif et s'il y a de l'argent
        if ($montant > 0 && $this->solde >= $montant) {
            $this->solde -= $montant;
        } else{
            echo "Montant invalide ou Solde insuffisant !!";
        }
    }
}

