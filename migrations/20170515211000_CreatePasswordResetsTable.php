<?php

use Core\Services\Contracts\Database;
use Core\Services\Contracts\Migration;

class CreatePasswordResetsTable implements Migration
{
    /**
     * @inheritdoc
     */
    public function up(Database $db)
    {
        $db->schema()->createTable('password_resets', [
            'email'      => ['type' => 'string'],
            'token'      => ['type' => 'string', 'size' =>  60],
//            'created_at' => ['type' => 'timestamp'], // todo!
        ]);

        $db->schema()->addIndex('password_resets', null, ['columns' => ['email', 'token'], 'unique'  => true]);
    }

    /**
     * @inheritdoc
     */
    public function down(Database $db)
    {
        $db->schema()->dropTable('password_resets');
    }
}