<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddArchiveColumnToFlowerTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('flowers');
        $table->addColumn('isArchived', 'integer', [
            'limit' => 1,
            'default' => 0,
            'null' => false,
            'signed' => false,
            'comment' => '0 = not archived, 1 = archived'
        ]);
        $table->update();
    }
}
