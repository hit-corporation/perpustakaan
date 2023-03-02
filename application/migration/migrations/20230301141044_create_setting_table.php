<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSettingTable extends AbstractMigration
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
      $table = $this->table('settings');
      $table->addColumn('max_allowed', 'integer', ['default' => 2]);
      $table->addColumn('due_date_value', 'integer', ['default' => 1]);
      $table->addColumn('due_date_unit', 'string', ['default' => 'weeks']);
      $table->addTimestamps();
      $table->create();
    }
}
