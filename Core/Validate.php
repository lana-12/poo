<?php

namespace App\Core;

class Validate
{
    /**
     * Validation si tous les champs du form sont remplis
     *
     * @param array $form array issu du form($_GET ou $_POST)
     * @param array $champs array listant des champs obligatoire
     * @return bool
     */
    public static function validate(array $form, array $champs): bool
    {
        // Parcourir les champs avec foreach
        foreach ($champs as $champ) {
            //Verification si absent ou vide
            if (!isset($form[$champ]) || empty($form[$champ])) {
                //On sort en return FALSE
                return false;
            }
        }
        return true;
    }

    /**
     * Verifed if unique e-mail
     *
     * @param [type] $user
     * @param [type] $email
     * @return void
     */
    public static function emailUnique($user, $email)
    {
        return $user->findBy(['email' => $email]) ? true : false;
    }


    /**
     * Validate format password
     * 8 caractères=>{8,} - 
     * 1 lettre en Maj => (?=.*?[A-Z])
     * 1 lettre en Maj => (?=.*?[a-z])
     * 1 chiffre => (?=.*?[0-9])
     * 1 caractère spécial => (?=.*?[#?!@$%^&*-])
     * '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $mdp
     * @param [type] $mdp
     * @return boolean
     */
    public static function isValidMDP($mdp)
    {
    return preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/', $mdp);
    }

}