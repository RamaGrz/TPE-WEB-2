<?php

class PlayerView {
    public function showPlayers($players) {
        // la vista define una nueva variable con la cantida de tareas
        $count = count($players);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        require 'templates/lista_tareas.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

    public function showPlayer($player){
        require 'templates/ver_detalles.phtml';
    }
}