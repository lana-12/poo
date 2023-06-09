<?php

namespace App\Core;

class Form 
{
    private $formCode = '';

    /**
     * Génère un form html
     *
     * @return void
     */
    public function create()
    {
        return $this->formCode;
    }

    /**
     * Add the attributes envoyés à la balise
     * @param array $attributes array associatif ['class'=> "form-control" , "required" => true]
     * @return string string générée
     */
    private function addAttributes(array $attributes): string
    {

        //Initialisation string
        $str ='';

        // Lister les attributs "court"
        $shorts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        // Boucler sur les attributs
        foreach($attributes as $attribute => $valeur){
            //Vérification si attributs est ds la liste des shorts + true
            if(in_array($attribute, $shorts) && $valeur == true){
                
                $str .= " $attribute";
            }else{
                // Add attribute='Valeur'
                $str .= " $attribute=\"$valeur\"";
            }
        }

        return $str;
    }

    /**
     * Balise ouverture du formulaire
     *
     * @param string $method => Méthode du form get ou post
     * @param string $action => Action du formulaire
     * @param array $attributes => Attributes
     * @return self
     */
    public function startForm(string $method= 'POST', string $action= '#', array $attributes= []): self
    {
        //Création de la balise <form....>
        $this->formCode .= "<form action='$action' method='$method'";

        //Add attributes éventuels
        // if($attributes){
            $this->formCode .= $attributes ? $this->addAttributes($attributes).'>': '>';
        // }
        return $this;
    }

    /**
     * Balise de fermeture du formulaire
     * @return self
     */
    public function endForm(): self
    {
        // Si on veut générer un token avec input hidden
        $token = md5(uniqid());
        $this->formCode .= "<input type='hidden' name='token' value='$token' ";

        $this->formCode .= '</form>';
        $_SESSION['token'] = $token;
        //Faire un dump()=> ds register ou login
        return $this;
    }


    /**
     * Add un label
     *
     * @param string $for 
     * @param string $text
     * @param array $attributes
     * @return self
     */
    public function addLabelFor(string $for, string $text, array $attributes=[]): self
    {
        //Ouvrir la balise
        $this->formCode .= "<label for='$for'";

        //Add les attributes éventuels
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        //Add le texte
        $this->formCode .= ">$text</label>";

        return $this;
    }

    /**
     * Add input
     *
     * @param string $type
     * @param string $name
     * @param array $attributes
     * @return self
     */
    public function addInput(string $type, string $name, array $attributes=[]):self
    {
        //Ouvrir la balise
        $this->formCode .= "<input type='$type' name='$name' ";

        //Add les attributs éventuels
        $this->formCode .= $attributes ? $this->addAttributes($attributes).'>' : '>';

        return $this;
    }

    /**
     * Add textarea
     *
     * @param string $name
     * @param string $valeur
     * @param array $attributes
     * @return self
     */
    public function addTextArea(string $name, string $valeur='', array $attributes=[]): self
    {
        //Ouvrir la balise
        $this->formCode .= "<textarea name='$name'";

        //Add les attributes éventuels
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        //Add le texte
        $this->formCode .= ">$valeur</textarea>";

        return $this;
    }

    /**
     * Add select
     *
     * @param string $name
     * @param array $options
     * @param array $attributes
     * @return self
     */
    public function addSelect(string $name, array $options, array $attributes=[]): self
    {
        //Ouvrir la balise
        $this->formCode .= "<select name='$name'";

        //Add les attributes éventuels
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        //Add options
        foreach($options as $value => $text){
            $this->formCode .= "<option value=\"$value\">$text</option>";
        }

        // Ferme le select
        $this->formCode .= "</select>";

        return $this;
    }


    /**
     * Add button
     *
     * @param string $text
     * @param array $attributes
     * @return self
     */
    public function addButton(string $type, string $text, array $attributes=[]): self
    {
        //Ouvrir la balise
        $this->formCode .= "<button type='$type'";

        // Add les attributs éventuels
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        //Ferme le button
        $this->formCode .= ">$text</button>";

        return $this;
    }
}