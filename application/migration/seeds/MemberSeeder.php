<?php
use Phinx\Seed\AbstractSeed;
use Faker\Factory as Faker;

class MemberSeeder extends AbstractSeed
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

        for($i=0;$i<=15;$i++)
        {
            $data[] = [
                'member_name' => $faker->unique()->name(),
                'no_induk'    => $faker->unique()->nik(),
                'email'       => $faker->unique()->email(),
                'address'     => $faker->unique()->address(),
                'phone'       => $faker->unique()->e164PhoneNumber()
            ];
        }

        $table = $this->table('members');
        $table->insert($data)->saveData();
    }
}
