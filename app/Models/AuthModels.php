<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModels extends Model
{
    protected $table      = 'users';
    protected $useAutoIncrement = true;
    protected $allowedFields =
    [
        'username',
        'password'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function auth_usermod($table, $data)
    {
        $db         = \Config\Database::connect();
        $builder    = $db->table($table);
        $builder->insert($data);
    }
}
