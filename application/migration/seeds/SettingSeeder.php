<?php


use Phinx\Seed\AbstractSeed;

class SettingSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
		$data = [
			[
				'field' => 'due_date',
				'key'	=> 'nilai',
				'value' => '1'
			],
			[
				'field' => 'due_date',
				'key'	=> 'unit',
				'value' => 'weeks'
			],
			[
				'field' => 'max_allowed_order',
				'key'	=> 'total',
				'value' => '2'
			],
		];

		$this->table('settings')->insert($data)->saveData();
    }
}
