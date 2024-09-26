<?php

class ClubView {
    public function showClubs($clubs) {
        // la vista define una nueva variable con la cantida de tareas
        

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        require 'templates/lista_clubes.phtml';
    }
    public function showClub($club){
        require 'templates/ver_clubes.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

   
}