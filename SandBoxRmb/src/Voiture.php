<?php

class Voiture
{
    public $marque = NULL;
    public $modele = NULL;
    public $puissance = "100 chevaux";

    public function __construct($marque, $modele)
    {
        $this -> marque = $marque;
        $this -> modele = $modele;
    }

    public function afficherMarque()
    {
        return $this -> marque;
    }

    public function afficherModele()
    {
        return $this -> modele;
    }

    public function afficherPuissance()
    {
        return $this -> puissance;
    }

    public function donneConsommation($vitesse)
    {
        if ($vitesse < 50) {
            return "5 litres";
        } elseif ($vitesse >= 50 && $vitesse < 90) {
            return "6 litres";
        } elseif ($vitesse >= 90 && $vitesse < 130) {
            return "7 litres";
        } else {
            return "8 litres";
        }
    }
}
