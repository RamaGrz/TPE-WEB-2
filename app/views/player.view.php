<?php

class PlayerView {
    public function showPlayers($players,$clubs) {
       

        require 'templates/lista_jugadores.phtml';
    }
    public function showPlayer($player){
        require 'templates/ver_jugadores.phtml';
    }
    public function showEdit($player,$clubs){
        require 'templates/editarJugador.phtml';
    }
    public function showError($error) {
        require 'templates/error.phtml';
    }

   
}