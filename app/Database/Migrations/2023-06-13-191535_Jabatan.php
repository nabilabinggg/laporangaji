<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jabatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jabatan'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'nama_jabatan'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255'
            ],
            'gaji_pokok'       => [
                'type'           => 'DOUBLE',
                'constraint'     => '20,2'
            ],
            'bonus'       => [
                'type'           => 'DOUBLE',
                'constraint'     => '20,2'
            ],
            'pph'       => [
                'type'           => 'DOUBLE',
                'constraint'     => '9,2'
            ],
            'created_at' => [
                'type'           => 'date'
            ],
            'updated_at' => [
                'type'          => 'date'
            ]
        ]);

        // Membuat primary key
        $this->forge->addKey('id_jabatan', TRUE);

        // Membuat tabel jabatan
        $this->forge->createTable('jabatan', TRUE);
    }

    //-------------------------------------------------------

    public function down()
    {
        // menghapus tabel jabatan
        $this->forge->dropTable('jabatan');
    }
}