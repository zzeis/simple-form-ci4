<?php

namespace App\Controllers;

use App\Models\pessoaModel;

class PessoaForm extends BaseController
{
    public function save()
    {

        // Recebe os dados POST
        $nome = $this->request->getPost('nome');
        $email = $this->request->getPost('email');
        $celular = $this->request->getPost('celular');
        $cpf = $this->request->getPost('cpf');
        $tipo = $this->request->getPost('tipo');
        $quantidade = $this->request->getPost('quantidade');
        $estadoTenda = $this->request->getPost('estadoTenda');
        $cpfFormatado = $this->clearCpf_CNPJ($cpf);
        $cpfFormatado2 = preg_replace('/[^0-9]/', '', $cpf);
     
        
        $data = [
            'cpf' => $cpfFormatado,
            'nome' => $nome,
            'celular' => $celular,
            'email' => $email,
            'tipo' => $tipo,
            'quantidade' => $quantidade,
            'estadoTenda' => $estadoTenda
        ];
        $pessoa = new pessoaModel();
        if ($this->validaDocumento($cpfFormatado2)) {
            if ($pessoa->save($data)) {
                $data['mensagem'] = 'Inscrição Enviada';
                $data['mensagem2'] = 'Acesse o site <a class="link" href="https://www.iguape.sp.gov.br/site/">Prefeitura de Iguape</a> para mais informações';
                $data['status'] = 'success';
                $this->email($email, $nome, $cpf, $tipo, $quantidade);
            } else {
                $data['mensagem'] = 'Erro ao registrar os dados';
                $data['status'] = 'error';
                $data['errors'] = $pessoa->errors();
            }
        } else {
            $data['errors'] = array('CPF ou CNPJ Invalido');
        }

        echo view('header/index');
        echo view('pages/finish', $data);
        echo view('footer/index');
    }




    function clearCPF_CNPJ($valor)
    {
        $valor = preg_replace('/[^a-zA-Z0-9\s]/', '', $valor);
        $valor = str_replace(['.', '-'], '', $valor);
        return $valor;
    }

    public function email($emailParam, $nome, $cpf, $tipo, $quantidade)
    {


        //email 
        $emailUser = $emailParam;
        $email = \Config\Services::email();
        $email->setFrom('seletivo@iguape.sp.gov.br', 'Prefeitura de Iguape');

        $email->setTo("$emailUser");
        //$email->setCC('another@another-example.com');
        // $email->setBCC('them@their-example.com');

        $email->setSubject('Confirmação - Sorteio - Festa do Bom Jesus De Iguape');

        $message = "Inscrição Concluida: " . "$nome -" . " $cpf" . " $tipo" . "- $quantidade";
        $email->setMessage($message);


        if ($email->send()) {
            echo "";
        } else {
            echo "error";
        }
    }

    function validaDocumento($documento)
    {
        // Remove caracteres não numéricos
        $documento = preg_replace('/[^0-9]/', '', $documento);

        // Valida CPF
        if (strlen($documento) === 11) {
            // Verifica se todos os dígitos são iguais
            if (preg_match('/^(\d)\1+$/', $documento)) {
                return false;
            }

            $soma = 0;

            // Cálculo do primeiro dígito verificador
            for ($i = 0, $j = 10; $i < 9; $i++, $j--) {
                $soma += $documento[$i] * $j;
            }

            $resto = $soma % 11;
            $digitoVerificador1 = ($resto < 2) ? 0 : 11 - $resto;

            if ($documento[9] != $digitoVerificador1) {
                return false;
            }

            $soma = 0;

            // Cálculo do segundo dígito verificador
            for ($i = 0, $j = 11; $i < 10; $i++, $j--) {
                $soma += $documento[$i] * $j;
            }

            $resto = $soma % 11;
            $digitoVerificador2 = ($resto < 2) ? 0 : 11 - $resto;

            if ($documento[10] != $digitoVerificador2) {
                return false;
            }

            return true;
        }

        // Valida CNPJ
        if (strlen($documento) === 14) {
            // Verifica se todos os dígitos são iguais
            if ($this->validaCNPJ($documento)) {
                return true;
            }
        }

        return false; // Documento inválido
    }
    function validaCNPJ($cnpj)
    {
        // Remove caracteres não numéricos
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        // Verifica se todos os dígitos são iguais
        if (preg_match('/^(\d)\1+$/', $cnpj)) {
            return false;
        }

        $soma = 0;
        $multiplicador = 2;

        // Cálculo do primeiro dígito verificador
        for ($i = 11; $i >= 0; $i--) {
            $soma += $cnpj[$i] * $multiplicador;
            $multiplicador = ($multiplicador + 1) % 9;
            if ($multiplicador < 2) {
                $multiplicador += 2;
            }
        }

        $resto = $soma % 11;
        $digitoVerificador1 = ($resto < 2) ? 0 : 11 - $resto;

        if ($cnpj[12] != $digitoVerificador1) {
            return false;
        }

        $soma = 0;
        $multiplicador = 2;

        // Cálculo do segundo dígito verificador
        for ($i = 12; $i >= 0; $i--) {
            $soma += $cnpj[$i] * $multiplicador;
            $multiplicador = ($multiplicador + 1) % 9;
            if ($multiplicador < 2) {
                $multiplicador += 2;
            }
        }

        $resto = $soma % 11;
        $digitoVerificador2 = ($resto < 2) ? 0 : 11 - $resto;

        if ($cnpj[13] != $digitoVerificador2) {
            return false;
        }

        return true;
    }
}
