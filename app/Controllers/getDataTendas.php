<?php

namespace App\Controllers;

use App\Models\pessoaModel;

class getDataTendas extends BaseController
{

    public function getTotal()
    {
        $pessoa = new pessoaModel();

        $total = $pessoa->get_pessoas();

        // Define o cabeçalho da resposta como JSON
        header('Content-Type: application/json');

        // Converte o array em uma string JSON
        $json = json_encode($total);

        // Retorna a string JSON na tela
        echo $json;
       
    }
}
