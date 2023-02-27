<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;


final class CreateTransactionTable extends AbstractMigration
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
        // UUID EXTENSION
        $this->execute('CREATE EXTENSION IF NOT EXISTS "uuid-ossp"');
        // TABLE
        $table = $this->table('transactions', ['id' => false, 'primary_key' => 'trans_id']);
        $table->addColumn('trans_id', 'uuid', ['default' => \Phinx\Util\Literal::from('uuid_generate_v4()')]);
        $table->addColumn('trans_timestamp', 'timestamp', ['default' => 'CURRENT_TIMESTAMP']);
        $table->addColumn('member_id', 'integer', ['null' => true]);

        $table->addForeignKey('member_id', 'members', 'id', ['update' => 'CASCADE', 'delete' => 'CASCADE']);
        $table->addTimestamps();
        $table->create();
    }
}
