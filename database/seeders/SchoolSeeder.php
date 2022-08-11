<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\SchoolDetail;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::create(['name' => 'MA AR-Risalah']);
        School::create(['name' => 'MA PPMTI Batang Kabung']);
        School::create(['name' => 'MA DR. H. Abdullah Ahmad PGAI']);
        School::create(['name' => 'MA Darul Ulum']);
        School::create(['name' => 'MA Kanzul Ulum']);
        School::create(['name' => 'MA Sabbihisma']);
        School::create(['name' => 'MA Dar El Iman']);
        School::create(['name' => 'MA Prof. Hamka']);

        //id = 1
        SchoolDetail::create([
            "school_id" => 1,
            "category_id" => 1,
            "value" => "Lokasi Ar-Risalah yang stategis dan kondusif serta bangunan dan fasilitas yang tertata dengan baik, sangat ideal untuk menunjang proses pembelajaran yang efektif dan menyenangkan. Dengan sistem boarding maka proses penyemaian ajaran Islam akan lebih cepat terinternalisasikan ke dalam jiwa santriwan/ti. Pondok pesantren ini berlokasi di Air Dingin RT.01 RW.IX Kel.Balai Gadang, Kec.Koto Tangah, Padang, Sumatera Barat."
        ]);
        SchoolDetail::create([
            "school_id" => 1,
            "category_id" => 2,
            "value" => "Terwujudnya generasi penuh berkah yang Qurani, berkarakter, dan berprestasi."
        ]);
        SchoolDetail::create([
            "school_id" => 1,
            "category_id" => 3,
            "value" => "Qurani, berkarakter, dan berprestasi."
        ]);
        SchoolDetail::create([
            "school_id" => 1,
            "category_id" => 4,
            "value" => "kemenag_mandiri"
        ]);
        SchoolDetail::create([
            "school_id" => 1,
            "category_id" => 5,
            "value" => "17870000"
        ]);
        SchoolDetail::create([
            "school_id" => 1,
            "category_id" => 6,
            "value" => "1650000"
        ]);
        SchoolDetail::create([
            "school_id" => 1,
            "category_id" => 7,
            "value" => "Pentas Seni Islam, Tahfizh Al-Quran"
        ]);
        SchoolDetail::create([
            "school_id" => 1,
            "category_id" => 8,
            "value" => "Asrama, Laboratorium (Fisika, Kimia, Biologi, Komputer), Gedung dan Lapangan Olahraga"
        ]);
        SchoolDetail::create([
            "school_id" => 1,
            "category_id" => 9,
            "value" => "Olimpiade (Matematika, biologi, Kimia, Fisika, Geografi, Ekonomi), Pramuka & Outbound, Sanggar Sastra & Jurnalistik"
        ]);

        //id = 2
        // SchoolDetail::create([
        //     "school_id" => 2,
        //     "category_id" => 1,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 2,
        //     "category_id" => 2,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 2,
        //     "category_id" => 3,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 2,
        //     "category_id" => 4,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 2,
        //     "category_id" => 5,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 2,
        //     "category_id" => 6,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 2,
        //     "category_id" => 7,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 2,
        //     "category_id" => 8,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 2,
        //     "category_id" => 9,
        //     "value" => ""
        // ]);

        //id =3
        SchoolDetail::create([
            "school_id" => 3,
            "category_id" => 1,
            "value" => ""
        ]);
        SchoolDetail::create([
            "school_id" => 3,
            "category_id" => 2,
            "value" => "Insan bertaqwa, berprestasi, berkarakter, berbudaya, serta berwawasan lingkungan."
        ]);
        SchoolDetail::create([
            "school_id" => 3,
            "category_id" => 3,
            "value" => "Mengoptimalkan penghayatan dan pengamalan nilai-nilai agama islam sehingga terbentuk perilaku akhlakul karimah; Meningkatkan prestasi akademik dan non-akademik melalu proses belajar yang kreatif dan inovatif; Mempersiapkan peserta didik berkepribadian cerdas, berkualitas dibidan imtaq dan imtek; Membentuk pribadi yang berbudi luhur agar dapat bersosialisasi dengan masyarakat yang beragam; Meningkatkan kesadaran untuk memelihara lingkungan MAS DR. H. Abdullah Ahmad PGAI yang bersih, hijau dan sehat"
        ]);
        SchoolDetail::create([
            "school_id" => 3,
            "category_id" => 4,
            "value" => "mandiri"
        ]);
        SchoolDetail::create([
            "school_id" => 3,
            "category_id" => 5,
            "value" => "0"
        ]);
        SchoolDetail::create([
            "school_id" => 3,
            "category_id" => 6,
            "value" => "0"
        ]);
        SchoolDetail::create([
            "school_id" => 3,
            "category_id" => 7,
            "value" => "Tahfizh Al-Quran"
        ]);
        SchoolDetail::create([
            "school_id" => 3,
            "category_id" => 8,
            "value" => "Makan harian"
        ]);
        SchoolDetail::create([
            "school_id" => 3,
            "category_id" => 9,
            "value" => "Futsal, Sepak Takraw, Hapkido"
        ]);

        // //id = 4
        // SchoolDetail::create([
        //     "school_id" => 4,
        //     "category_id" => 1,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 4,
        //     "category_id" => 2,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 4,
        //     "category_id" => 3,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 4,
        //     "category_id" => 4,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 4,
        //     "category_id" => 5,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 4,
        //     "category_id" => 6,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 4,
        //     "category_id" => 7,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 4,
        //     "category_id" => 8,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 4,
        //     "category_id" => 9,
        //     "value" => ""
        // ]);

        // //id = 5
        SchoolDetail::create([
            "school_id" => 5,
            "category_id" => 1,
            "value" => ""
        ]);
        SchoolDetail::create([
            "school_id" => 5,
            "category_id" => 2,
            "value" => ""
        ]);
        SchoolDetail::create([
            "school_id" => 5,
            "category_id" => 3,
            "value" => ""
        ]);
        SchoolDetail::create([
            "school_id" => 5,
            "category_id" => 4,
            "value" => "mandiri"
        ]);
        SchoolDetail::create([
            "school_id" => 5,
            "category_id" => 5,
            "value" => "0"
        ]);
        SchoolDetail::create([
            "school_id" => 5,
            "category_id" => 6,
            "value" => "500000"
        ]);
        SchoolDetail::create([
            "school_id" => 5,
            "category_id" => 7,
            "value" => "Tahfizh Al-Quran, Tahfizh Hadits"
        ]);
        SchoolDetail::create([
            "school_id" => 5,
            "category_id" => 8,
            "value" => "-"
        ]);
        SchoolDetail::create([
            "school_id" => 5,
            "category_id" => 9,
            "value" => "Berkuda"
        ]);

        // //id = 6
        // SchoolDetail::create([
        //     "school_id" => 6,
        //     "category_id" => 1,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 6,
        //     "category_id" => 2,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 6,
        //     "category_id" => 3,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 6,
        //     "category_id" => 4,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 6,
        //     "category_id" => 5,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 6,
        //     "category_id" => 6,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 6,
        //     "category_id" => 7,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 6,
        //     "category_id" => 8,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 6,
        //     "category_id" => 9,
        //     "value" => ""
        // ]);

        // //id = 7
        // SchoolDetail::create([
        //     "school_id" => 7,
        //     "category_id" => 1,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 7,
        //     "category_id" => 2,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 7,
        //     "category_id" => 3,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 7,
        //     "category_id" => 4,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 7,
        //     "category_id" => 5,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 7,
        //     "category_id" => 6,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 7,
        //     "category_id" => 7,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 7,
        //     "category_id" => 8,
        //     "value" => ""
        // ]);
        // SchoolDetail::create([
        //     "school_id" => 7,
        //     "category_id" => 9,
        //     "value" => ""
        // ]);

        // //id = 8
        SchoolDetail::create([
            "school_id" => 8,
            "category_id" => 1,
            "value" => "Pesantren Modern Terpadu (PMT) Prof. DR. Hamka merupakan sekolah berasrama yang berada di bawah Kemendikbud yang memadukan antara pendiidkan umum dan agama. Berlokasi di Jl. Raya Bypass KM 15 Kel. Aia Pacah, Kec.Koto Tangah, Kota Padang."
        ]);
        SchoolDetail::create([
            "school_id" => 8,
            "category_id" => 2,
            "value" => "Menjadi lembaga pendidikan yang unggul dengan mengintegrasikan pendidikan agama dan umum yang berkualitas, diperhitungkan, didambakan dan dibanggakan."
        ]);
        SchoolDetail::create([
            "school_id" => 8,
            "category_id" => 3,
            "value" => "Beriman, bertaqwa dan berakhlak mulia; Memiliki ilmu pengetahuan yang berkualitas sesuai tuntutan zaman; Memiliki sikap tawadhu', objektif dan berjiwa bersih; Kreatif, dinamis dan bersikap positif terhadap kemajuan dan tantangan zaman."
        ]);
        SchoolDetail::create([
            "school_id" => 8,
            "category_id" => 4,
            "value" => "kemendikbud_mandiri"
        ]);
        SchoolDetail::create([
            "school_id" => 8,
            "category_id" => 5,
            "value" => "16350000"
        ]);
        SchoolDetail::create([
            "school_id" => 8,
            "category_id" => 6,
            "value" => "2150000"
        ]);
        SchoolDetail::create([
            "school_id" => 8,
            "category_id" => 7,
            "value" => "Tahfizh AL-Quran, Program studi banding ke luar negeri, Kelas khusus pembelajaran personal."
        ]);
        SchoolDetail::create([
            "school_id" => 8,
            "category_id" => 8,
            "value" => "Lapangan olahraga (Badminton, Bola Voli, Bola Basket, Takraw, Sepak Bola dan Futsal), Gedung serba guna, Labor Komputer, Laundry, Gedung Seni dan Budaya, Studio Broadcasting."
        ]);
        SchoolDetail::create([
            "school_id" => 8,
            "category_id" => 9,
            "value" => "Pramuka, Paskibra. Tahfizh Al-QUran, Tilawah dan Tartil Al-Quran, Tabligh, Futsal, Badminton, Sepak Bola, Sepak Takraw, Bola Voli, Bola Basket, Tapak Suci, Desain Grafis, Jurnalistik, Arabic Club, English Club, Nasyid, Seni Tari, Marching Band, Olimpiade."
        ]);
    }
}
