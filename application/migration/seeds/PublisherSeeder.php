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
				'publisher_name' => 'Erlangga',
				'address'        => 'Jl. H. Baping Raya No. 100 Ciracas Jakarta 13740',
			],
            [
				'publisher_name' => 'Yudhistira',
				'address'        => 'Jl. Jend Sudirman Kav 59 Gelora Tanah Abang Jakarta Pusat DKI Jakarta',
			],
            [
                'publisher_name' => 'PT Elex Media Komputindo',
                'address'        => 'Jl. Palmerah Barat 29-31'
            ],
            [
                'publisher_name' => 'Tiga Serangkai',
                'address'        => 'Jl. Otista 3 No.42, RT.1/RW.8, Cipinang Cempedak, Kecamatan Jatinegara'
            ],
            [
                'publisher_name' => 'Ganeca Exact',
                'address'        => 'JL. P. Selayar Kav. A5, Kawasan Industri MM 2100, Bekasi'
            ]
        ];

        $table = $this->table('publishers');

        $table->insert($data)->saveData();
    }
}
