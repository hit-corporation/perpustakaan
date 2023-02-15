<?php


use Phinx\Seed\AbstractSeed;

class PublisherSeeder extends AbstractSeed
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
				'publisher_name' => 'Airlangga',
				'address' => 'Jl. Airlangga No. 1, Surabaya',
				'created_at' => date('Y-m-d H:i:s'),
			],
        ];

        $table = $this->table('publishers');

        $table->insert($data)->saveData();
    }
}
