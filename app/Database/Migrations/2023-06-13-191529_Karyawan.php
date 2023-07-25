<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Karyawan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_karyawan'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'jabatan_id'       => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'nik'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '16'
            ],
            'nama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255'
            ],
            'no_telp'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '13'
            ],
            'alamat'       => [
                'type'           => 'LONGTEXT'
            ],
            'karyawan_created_at' => [
                'type'           => 'date'
            ],
            'updated_at' => [
                'type'          => 'date'
            ]
        ]);

        // Membuat primary key
        $this->forge->addKey('id_karyawan', TRUE);

        // Membuat tabel karyawan
        $this->forge->createTable('karyawan', TRUE);
    }

    //-------------------------------------------------------

    public function down()
    {
        // menghapus tabel karyawan
        $this->forge->dropTable('karyawan');
    }
}