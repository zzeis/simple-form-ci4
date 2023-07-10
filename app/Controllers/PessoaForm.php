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
                $data['mensagem'] = 'title notificaion';
                $data['mensagem2'] = 'info notification';
                $data['status'] = 'success'; //simbol
                $this->email($email, $nome, $cpf, $tipo, $quantidade);
            } else {
                $data['mensagem'] = 'Error';
                $data['status'] = 'error'; //simbol
                $data['errors'] = $pessoa->errors();
            }
        } else {
            $data['errors'] = array('CPF Invalido');
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
        $email->setFrom('example@gmail.com', 'NameEmail');

        $email->setTo("$emailUser");


        $email->setSubject('Title EMAIL');

        $message = "Test email message";
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


        return false; // Documento inválido
    }
}
