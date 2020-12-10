<?php

use Migrations\AbstractMigration;

class AddReceiptFlagAndMoreToBidinfo extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('bidinfo');
        $table->addColumn('is_received', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->addColumn('is_sent', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->update();
    }
}
