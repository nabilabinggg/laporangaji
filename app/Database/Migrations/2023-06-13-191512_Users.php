<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_users'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'username'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'password'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
            ],
            'created_at' => [
                'type'           => 'datetime'
            ],
            'updated_at' => [
                'type'          => 'datetime'
            ]
        ]);

        // Membuat primary key
        $this->forge->addKey('id_users', TRUE);

        // Membuat tabel users
        $this->forge->createTable('users', TRUE);
    }

    //-------------------------------------------------------

    public function down()
    {
        // menghapus tabel users
        $this->forge->dropTable('users');
    }
}
