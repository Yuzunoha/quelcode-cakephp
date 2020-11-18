<?php

use Migrations\AbstractMigration;

class AddAddressAndMoreToBidinfo extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('bidinfo');
        $table->addColumn('bidder_name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('bidder_address', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('bidder_tell', 'string', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->update();
    }
}
