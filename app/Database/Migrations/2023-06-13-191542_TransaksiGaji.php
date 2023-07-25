<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransaksiGaji extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'jabatan_id'       => [
                'type'           => 'INT',
                'constraint'     => '11'
            ],
            'karyawan_id'       => [
                'type'           => 'INT',
                'constraint'     => '11'
            ],
            'created_at' => [
                'type'           => 'date'
            ],
            'updated_at' => [
                'type'          => 'date'
            ]
        ]);

        // Membuat primary key
        $this->forge->addKey('id_transaksi', TRUE);

        // Membuat tabel transaksi
        $this->forge->createTable('transaksi_gaji', TRUE);
    }

    //-------------------------------------------------------

    public function down()
    {
        // menghapus tabel transaksi
        $this->forge->dropTable('transaksi_gaji');
    }
}