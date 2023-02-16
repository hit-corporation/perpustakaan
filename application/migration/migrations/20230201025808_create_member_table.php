<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateMemberTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
		$table = $this->table('members');
		$table->addColumn('member_name', 'string', ['limit' => 100])
			  ->addColumn('no_induk', 'string', ['limit' => 100])
			  ->addColumn('email', 'string', ['limit' => 100])
			  ->addColumn('address', 'string', ['limit' => 255])
			  ->addColumn('phone', 'string', ['limit' => 100])
			  ->addColumn('created_at', 'datetime', ['null' => true])
			  ->addColumn('updated_at', 'datetime', ['null' => true])
			  ->addColumn('deleted_at', 'datetime', ['null' => true])

			  ->addIndex('no_induk', ['unique' => true])
			  ->create();
    }
}
