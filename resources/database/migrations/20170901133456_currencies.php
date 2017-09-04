<?php

use Phinx\Migration\AbstractMigration;

class Currencies extends AbstractMigration
{
    public function change()
    {
        $this
            ->table('currencies')
            ->addColumn('iso', 'string', ['limit' => 3])
            ->addColumn('symbol', 'string')
            ->create();
    }
}
