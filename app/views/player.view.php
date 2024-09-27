<?php

class PlayerView {
    public function showPlayers($players) {
       

        require 'templates/lista_jugadores.phtml';
    }
    public function showPlayer($player){
        require 'templates/ver_jugadores.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

   
}