<?php

use Migrations\AbstractMigration;

class AddStatusToTestData extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('test_data');
        $table->addColumn('status', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->update();
    }
}
