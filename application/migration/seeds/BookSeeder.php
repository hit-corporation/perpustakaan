<?php
use Phinx\Seed\AbstractSeed;
use Faker\Factory as Faker;

class BookSeeder extends AbstractSeed
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
        $data = [];

        $faker = Faker::create('id_ID');

        for($i=0;$i<=4;$i++)
        {
			$img = [
				'529af9ef9ae8d6dc362a024a7231cbbb.jpg', 
				'12405a0f13ff2a93edf8fc96383dda05.jpg', 
				'fde0e522fa00da1468dbcc84e89f01e9.jpg', 
				'8419f965f5089e31e9719cf816840e31.jpg',
				'5f4c1c8a97fbbf9a6379d2a2d5d14eca.jpg'];

            $data[] = [
                'title'	 		=> $faker->unique()->name(),
                'cover_img'    	=> $img[$i],
                'author'       	=> $faker->randomNumber(9),
                'publish_year'	=> $faker->year(),
                'category_id'	=> $i < 3 ? 6 : 7,
				'publisher_id'	=> 1,
				'description'	=> $faker->text(),
				'qty'			=> 5
            ];
        }

        $table = $this->table('books');
        $table->insert($data)->saveData();
    }
}
