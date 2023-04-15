<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Todo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'todo_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'todo_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'todo_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'todo_status' => [
                'type' => 'boolean',
                'default' => false,
            ],
        ]);
        $this->forge->addKey('todo_id', true);
        $this->forge->createTable('todos');
    }

    public function down()
    {
        $this->forge->dropTable('todos');
    }
}
