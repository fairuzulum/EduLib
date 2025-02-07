<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menyalin gambar cover ke storage/public/images/
        $sourcePath = 'C:/images/cover.png';  // Ganti dengan path gambar yang sesuai
        $destinationPath = 'images/cover.png';  // Gambar akan disalin ke public/images

        Storage::disk('public')->put($destinationPath, file_get_contents($sourcePath));

        // Data buku pertama
        Book::create([
            'title' => 'Mencari Cinta Sejati',
            'author' => 'Ayu Utami',
            'genre' => 'Romantis',
            'publisher' => 'Pustaka Lestari',
            'published_year' => 2018,
            'description' => 'Mencari Cinta Sejati adalah sebuah novel yang mengisahkan perjalanan seorang wanita muda dalam mencari makna cinta sejati. Di dalam cerita ini, pembaca akan dibawa untuk menyelami konflik batin yang dialami oleh tokoh utama, yang mengalami pergulatan antara harapan dan kenyataan. Novel ini menawarkan perspektif baru tentang arti sejati dari cinta, bukan hanya sebagai perasaan, tetapi juga sebagai perjalanan hidup yang penuh dengan ujian dan pembelajaran.',
            'cover_image' => $destinationPath,
            'status' => 'available',
        ]);

        // Data buku kedua
        Book::create([
            'title' => 'Keajaiban Pagi',
            'author' => 'Dewi Lestari',
            'genre' => 'Motivasi',
            'publisher' => 'Gramedia',
            'published_year' => 2020,
            'description' => 'Keajaiban Pagi adalah buku motivasi yang mengajak pembaca untuk memulai hari dengan cara yang berbeda. Dalam buku ini, Dewi Lestari membagikan pengalaman pribadinya yang menginspirasi untuk memulai pagi dengan kebiasaan positif, seperti meditasi, olahraga, dan menulis jurnal. Buku ini bukan hanya memberikan tips praktis, tetapi juga memberikan motivasi bagi setiap pembaca untuk menemukan potensi terbaik dalam diri mereka dan menjalani hidup dengan penuh semangat.',
            'cover_image' => $destinationPath,
            'status' => 'available',
        ]);

        // Data buku ketiga
        Book::create([
            'title' => 'Langit Tidak Selalu Cerah',
            'author' => 'Andrea Hirata',
            'genre' => 'Drama',
            'publisher' => 'Bentang Pustaka',
            'published_year' => 2017,
            'description' => 'Langit Tidak Selalu Cerah adalah novel yang mengisahkan tentang perjuangan seorang pemuda dalam menghadapi kehidupan yang penuh dengan tantangan. Tokoh utama dalam cerita ini harus menghadapi kenyataan pahit tentang masa lalu dan masa depan yang penuh ketidakpastian. Namun, dengan tekad dan harapan, ia berusaha untuk mengubah hidupnya. Novel ini mengandung pesan moral yang mendalam tentang kekuatan dari keteguhan hati dan optimisme dalam menghadapi cobaan hidup.',
            'cover_image' => $destinationPath,
            'status' => 'available',
        ]);

        // Data buku keempat
        Book::create([
            'title' => 'Malam yang Terlupakan',
            'author' => 'Tere Liye',
            'genre' => 'Fiksi',
            'publisher' => 'Elex Media',
            'published_year' => 2019,
            'description' => 'Malam yang Terlupakan adalah novel fiksi yang membawa pembaca ke dalam dunia misteri dan petualangan yang menegangkan. Cerita ini dimulai dengan hilangnya seorang tokoh penting dalam kehidupan tokoh utama, yang kemudian berusaha untuk mencari tahu apa yang sebenarnya terjadi. Setiap halaman dalam buku ini penuh dengan kejutan yang membuat pembaca terus ingin tahu bagaimana cerita ini berakhir. Selain itu, novel ini juga menyentuh tema-tema tentang kehilangan, pengorbanan, dan pencarian jati diri.',
            'cover_image' => $destinationPath,
            'status' => 'available',
        ]);
    }
}
