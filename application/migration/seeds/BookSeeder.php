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
            $data = [
				[
					'title'	 		=> 'Sinau Basa Jawa SD Kelas 6 K13 Revisi',
					'cover_img'    	=> '5f4c1c8a97fbbf9a6379d2a2d5d14eca.jpg',
					'author'       	=> 'Sri Wahyuni',
					'isbn'			=> '9786020310001',
					'publish_year'	=> '2018',
					'category_id'	=> 6,
					'publisher_id'	=> 1,
					'description'	=> 'Buku ini merupakan buku pelajaran yang dikhususkan untuk siswa kelas 6 SD yang mengikuti kurikulum 2013 revisi. Buku ini berisi materi-materi yang dibagi menjadi 10 bab, yaitu: 1. Kata Kerja, 2. Kata Sifat, 3. Kata Benda, 4. Kata Ganti, 5. Kalimat, 6. Kalimat Tanya, 7. Kalimat Perintah, 8. Kalimat Sifat, 9. Kalimat Tanya Sifat, dan 10. Kalimat Perintah Sifat. Setiap bab diawali dengan materi yang berisi penjelasan tentang materi yang akan dipelajari, contoh-contoh, dan latihan soal. Setelah itu, siswa akan diberikan latihan soal yang lebih banyak dan lebih rumit. Setiap bab diakhiri dengan latihan soal yang lebih rumit lagi. Buku ini juga dilengkapi dengan kunci jawaban yang dapat digunakan untuk memeriksa jawaban siswa. Buku ini dapat digunakan oleh siswa kelas 6 SD yang mengikuti kurikulum 2013 revisi.',
					'qty'			=> 5
				],
				[
					'title'	 		=> 'Bhs. Indonesia 1 SMP/Mts Kelas VII Kur. Merdeka',
					'cover_img'    	=> '529af9ef9ae8d6dc362a024a7231cbbb.jpg',
					'author'       	=> 'E.B Devitta Ekawati, Indah Wukir Setiarini',
					'isbn'			=> '9786020310002',
					'publish_year'	=> '2022',
					'category_id'	=> 5,
					'publisher_id'	=> 1,
					'description'	=> 'Buku ini merupakan buku pelajaran yang dikhususkan untuk siswa kelas 7 SMP/MTs yang mengikuti kurikulum 2013 revisi. Buku ini berisi materi-materi yang dibagi menjadi 10 bab, yaitu: 1. Kata Kerja, 2. Kata Sifat, 3. Kata Benda, 4. Kata Ganti, 5. Kalimat, 6. Kalimat Tanya, 7. Kalimat Perintah, 8. Kalimat Sifat, 9. Kalimat Tanya Sifat, dan 10. Kalimat Perintah Sifat. Setiap bab diawali dengan materi yang berisi penjelasan tentang materi yang akan dipelajari, contoh-contoh, dan latihan soal. Setelah itu, siswa akan diberikan latihan soal yang lebih banyak dan lebih rumit. Setiap bab diakhiri dengan latihan soal yang lebih rumit lagi. Buku ini juga dilengkapi dengan kunci jawaban yang dapat digunakan untuk memeriksa jawaban siswa. Buku ini dapat digunakan oleh siswa kelas 7 SMP/MTs yang mengikuti kurikulum 2013 revisi.',
					'qty'			=> 4
				],
				[
					'title'	 		=> 'Senang Belajar PPKn SD Kelas 6 K13 Revisi',
					'cover_img'    	=> '8419f965f5089e31e9719cf816840e31.jpg',
					'author'       	=> 'Sri Wahyuni',
					'isbn'			=> '9786020310003',
					'publish_year'	=> '2021',
					'category_id'	=> 6,
					'publisher_id'	=> 1,
					'description'	=> 'Buku ini merupakan buku pelajaran yang dikhususkan untuk siswa kelas 6 SD yang mengikuti kurikulum 2013 revisi. Buku ini berisi materi-materi yang dibagi menjadi 10 bab, yaitu: 1. Kata Kerja, 2. Kata Sifat, 3. Kata Benda, 4. Kata Ganti, 5. Kalimat, 6. Kalimat Tanya, 7. Kalimat Perintah, 8. Kalimat Sifat, 9. Kalimat Tanya Sifat, dan 10. Kalimat Perintah Sifat. Setiap bab diawali dengan materi yang berisi penjelasan tentang materi yang akan dipelajari, contoh-contoh, dan latihan soal. Setelah itu, siswa akan diberikan latihan soal yang lebih banyak dan lebih rumit. Setiap bab diakhiri dengan latihan soal yang lebih rumit lagi. Buku ini juga dilengkapi dengan kunci jawaban yang dapat digunakan untuk memeriksa jawaban siswa. Buku ini dapat digunakan oleh siswa kelas 6 SD yang mengikuti kurikulum 2013 revisi.',
					'qty'			=> 3
				],
				[
					'title'	 		=> 'IPA 1 SMP/Mts Kelas VII Kur. Merdeka',
					'cover_img'    	=> '12405a0f13ff2a93edf8fc96383dda05.jpg',
					'author'		=> 'Dina Kurniawati dkk.',
					'isbn'			=> '9786020310004',
					'publish_year'	=> '2020',
					'category_id'	=> 5,
					'publisher_id'	=> 1,
					'description'	=> 'Buku ini merupakan buku pelajaran yang dikhususkan untuk siswa kelas 7 SMP/MTs yang mengikuti kurikulum 2013 revisi. Buku ini berisi materi-materi yang dibagi menjadi 10 bab, yaitu: 1. Kata Kerja, 2. Kata Sifat, 3. Kata Benda, 4. Kata Ganti, 5. Kalimat, 6. Kalimat Tanya, 7. Kalimat Perintah, 8. Kalimat Sifat, 9. Kalimat Tanya Sifat, dan 10. Kalimat Perintah Sifat. Setiap bab diawali dengan materi yang berisi penjelasan tentang materi yang akan dipelajari, contoh-contoh, dan latihan soal. Setelah itu, siswa akan diberikan latihan soal yang lebih banyak dan lebih rumit. Setiap bab diakhiri dengan latihan soal yang lebih rumit lagi. Buku ini juga dilengkapi dengan kunci jawaban yang dapat digunakan untuk memeriksa jawaban siswa. Buku ini dapat digunakan oleh siswa kelas 7 SMP/MTs yang mengikuti kurikulum 2013 revisi.',
					'qty'			=> 2
				],
				[
					'title'	 		=> 'Jelajah Sains SD Kelas 6 K13 Revisi',
					'cover_img'		=> 'fde0e522fa00da1468dbcc84e89f01e9.jpg',
					'author'		=> 'Dian Oki Valerina',
					'isbn'			=> '9786020310005',
					'publish_year'	=> '2019',
					'category_id'	=> 6,
					'publisher_id'	=> 1,
					'description'	=> 'Buku ini merupakan buku pelajaran yang dikhususkan untuk siswa kelas 6 SD yang mengikuti kurikulum 2013 revisi. Buku ini berisi materi-materi yang dibagi menjadi 10 bab, yaitu: 1. Kata Kerja, 2. Kata Sifat, 3. Kata Benda, 4. Kata Ganti, 5. Kalimat, 6. Kalimat Tanya, 7. Kalimat Perintah, 8. Kalimat Sifat, 9. Kalimat Tanya Sifat, dan 10. Kalimat Perintah Sifat. Setiap bab diawali dengan materi yang berisi penjelasan tentang materi yang akan dipelajari, contoh-contoh, dan latihan soal. Setelah itu, siswa akan diberikan latihan soal yang lebih banyak dan lebih rumit. Setiap bab diakhiri dengan latihan soal yang lebih rumit lagi. Buku ini juga dilengkapi dengan kunci jawaban yang dapat digunakan untuk memeriksa jawaban siswa. Buku ini dapat digunakan oleh siswa kelas 6 SD yang mengikuti kurikulum 2013 revisi.',
					'qty'			=> 1
				]

            ];
        }

        $table = $this->table('books');
        $table->insert($data)->saveData();
    }
}
