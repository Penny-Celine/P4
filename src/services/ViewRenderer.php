<?php

namespace App\Services;

class ViewRenderer
{
    public function render(string $template, array $content = [])
    //ici le "soucis" c'est que l'array $content contient des objets et non des paires clé->valeur
    {
        echo 'ici c\'est ok';
        extract($content);
        ob_start();
        require sprintf('src/view/%s', $template);
        echo 'ceci fonctionne';
        return ob_get_clean();
    }
}