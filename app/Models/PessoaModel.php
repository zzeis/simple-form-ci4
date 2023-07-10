<?php

namespace App\Models;

use CodeIgniter\Model;

class pessoaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tendas_dados';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nome', 'cpf', 'email', 'celular','tipo','quantidade','estadoTenda'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    /* Defining the validation rules for the model. */
    protected $validationRules      = [
        'nome'      => 'required',
        'tipo'      => 'required',
        'quantidade' => 'required',
        'estadoTenda' => 'required',
        'cpf'       => 'required|is_unique[tendas_dados.cpf]',
        'email'     => 'required|is_unique[tendas_dados.email]|valid_email'

    ];

    protected $validationMessages   = [
        'cpf' => [
            'is_unique' => 'CPF já utilizado!'
        ],
        'email' => [
            'is_unique' => 'Email já cadastrado!'
        ],
        'tipo' => [
            'required' => 'O campo Espaço é obrigatorio!'
        ],
        'estadoTenda' => [
            'required' => 'O campo Contíguas ou Separadas é obrigatorio!'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function get_pessoas()
    {
        $db = \Config\Database::connect();
        $db = db_connect();

        $sql = "SELECT count(nome) AS total FROM tendas_dados WHERE DAY(created_at) >= 26";
        $result = $db->query($sql)->getRow();

        return $result; // Retorna o objeto resultante
    }
}
