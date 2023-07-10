<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $currentDate = date('Y-m-d'); // Obtém a data atual no formato "ano-mês-dia"

        // Verifica se a data atual é menor ou igual a 07/07/2023
        if ($currentDate <= '2023-07-11') {
            echo view('header/index');
            echo view('home/index');
            echo view('footer/index');
        } else {
            return redirect()->to('/closed'); // Redireciona para a página de fechamento
        }
    }
    public function teste222()
    {
        $currentDate = date('Y-m-d'); // Obtém a data atual no formato "ano-mês-dia"

        // Verifica se a data atual é menor ou igual a 07/07/2023
        if ($currentDate <= '2023-07-07') {
            echo view('header/index');
            echo view('home/index');
            echo view('footer/index');
        } else {
            return redirect()->to('/closed'); // Redireciona para a página de fechamento
        }
    }

    public function closed()
    {
        echo view('header/index');
        echo view('pages/closed');
        echo view('footer/index');
    }
}
