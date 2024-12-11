<?php

namespace App\Controllers;

class MainController extends \Leaf\Controller
{
    function home() {
        render('home');
    }

    function about() {
        $texte = 'Ceci est la page about';
        render('about', compact('texte')); // compact('texte') = ['texte' => $texte] sert pour passer des variables
    }

    function contact() {
        render('contact');
    }

    function faq() {
        render('faq');
    }
}
