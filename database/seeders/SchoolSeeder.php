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
        School::create(['name' => 'MA Prof. DR. Hamka']);

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
        SchoolDetail::create([
            "school_id" => 2,
            "category_id" => 1,
            "value" => "PPMTI Batang Kabung merupakan pondok pesantren modern yang terletak di Jl. Adinegoro, Batang Kabung Ganting, Kec. Koto Tangah, Kota Padang."
        ]);
        SchoolDetail::create([
            "school_id" => 2,
            "category_id" => 2,
            "value" => "UNGGUL DALAM ILMU, TERAMPIL DALAM AMAL, DAN MULIA DALAM AKHLAK"
        ]);
        SchoolDetail::create([
            "school_id" => 2,
            "category_id" => 3,
            "value" => "Mendidik Peserta didik memiliki Kesadaran Ketuhanan (spiritual makrifat); Mengamalkan Al Qur’an dan Sunnah Rasulullah SAW; Mengembangkan potensi peserta didik berjiwa  mandiri, beretos kerja keras, wirausaha, kompetetif dan jujur; Membentuk kader persyarikatan, ummat dan bangsa yang ikhlas, peka, peduli dan bertanggungjawab terhadap kemanusiaan dan lingkungan."
        ]);
        SchoolDetail::create([
            "school_id" => 2,
            "category_id" => 4,
            "value" => "kemenag_mandiri"
        ]);
        SchoolDetail::create([
            "school_id" => 2,
            "category_id" => 5,
            "value" => "1250000"
        ]);
        SchoolDetail::create([
            "school_id" => 2,
            "category_id" => 6,
            "value" => "340000"
        ]);
        SchoolDetail::create([
            "school_id" => 2,
            "category_id" => 7,
            "value" => "Tahfiz Quran, Beasiswa bagi siswa berprestasi"
        ]);
        SchoolDetail::create([
            "school_id" => 2,
            "category_id" => 8,
            "value" => "Labor Komputer, UKS, Perpustakaan, Lapangan Olahraga Multifungsi"
        ]);
        SchoolDetail::create([
            "school_id" => 2,
            "category_id" => 9,
            "value" => "Bahasa Arab, Bahasa Inggris, Futsal, Bola Voli, Pencak Silat."
        ]);

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

        //id = 4
        SchoolDetail::create([
            "school_id" => 4,
            "category_id" => 1,
            "value" => "Pondok Pesantren Darul Ulum merupakan pondok pesantren yang terletak di Kalumbuk, Kec. Kuranji, Kota Padang, Sumatera Barat."
        ]);
        SchoolDetail::create([
            "school_id" => 4,
            "category_id" => 2,
            "value" => "Berilmu, Beramal dan Bertaqwa serta dilandasi Akhlakul Karimah"
        ]);
        SchoolDetail::create([
            "school_id" => 4,
            "category_id" => 3,
            "value" => "Menumbuhkan budaya ilmu, amal, taqwa serta akhlakul karimah."
        ]);
        SchoolDetail::create([
            "school_id" => 4,
            "category_id" => 4,
            "value" => "kemenag_mandiri"
        ]);
        SchoolDetail::create([
            "school_id" => 4,
            "category_id" => 5,
            "value" => "1330000"
        ]);
        SchoolDetail::create([
            "school_id" => 4,
            "category_id" => 6,
            "value" => "325000"
        ]);
        SchoolDetail::create([
            "school_id" => 4,
            "category_id" => 7,
            "value" => "Kitab Kuning, Tahfiz Quran, Dauroh Lughotul Arobiyah."
        ]);
        SchoolDetail::create([
            "school_id" => 4,
            "category_id" => 8,
            "value" => "Labor Komputer"
        ]);
        SchoolDetail::create([
            "school_id" => 4,
            "category_id" => 9,
            "value" => "Jurnalistik, Leadership, Seni membaca Al-quran"
        ]);

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
        SchoolDetail::create([
            "school_id" => 6,
            "category_id" => 1,
            "value" => "Pondok Pesantren Sabbihisma merupakan pondok pesantren yang berlokasi di Jl. Anak Air No.60, Batipuh Panjang, Kec. Koto Tangah, Kota Padang, Sumatera Barat."
        ]);
        SchoolDetail::create([
            "school_id" => 6,
            "category_id" => 2,
            "value" => "Menyiapkan santri lulusan TMI yang beraqidah kuat, berakhlak mulia, gemar beribadah, berilmu, mandiri, memiliki keahlian dan keterampilan hidup, profesional dan mampu memberi manfaat bagi kehidupan masyarakat."
        ]);
        SchoolDetail::create([
            "school_id" => 6,
            "category_id" => 3,
            "value" => "Menerapkan prinsip pendidikan Islam terpadu; Menyusun dan menerapkan kurikulum terpadu; Menerapkan pendidikan dan pembinaan aqidah, akhlak dan ibadah; Menerapkan pendidikan dan pembinaan keilmuwan dan keahlian."
        ]);
        SchoolDetail::create([
            "school_id" => 6,
            "category_id" => 4,
            "value" => "kemenag_mandiri"
        ]);
        SchoolDetail::create([
            "school_id" => 6,
            "category_id" => 5,
            "value" => "3000000"
        ]);
        SchoolDetail::create([
            "school_id" => 6,
            "category_id" => 6,
            "value" => "300000"
        ]);
        SchoolDetail::create([
            "school_id" => 6,
            "category_id" => 7,
            "value" => "Tahfiz Quran"
        ]);
        SchoolDetail::create([
            "school_id" => 6,
            "category_id" => 8,
            "value" => "Labor Komputer, Lapangan Olahraga."
        ]);
        SchoolDetail::create([
            "school_id" => 6,
            "category_id" => 9,
            "value" => "Futsal, Basket, Voli, Bahasa Arab, Pencak Silat."
        ]);

        // //id = 7
        SchoolDetail::create([
            "school_id" => 7,
            "category_id" => 1,
            "value" => "Pondok Pesantren Dar El-Iman merupakan pondok pesantren yang berlokasi di Jl. Gajah Mada Dalam, Komplek BPKP II, Kampung Olo, Kecamatan Nanggalo, Kota Padang."
        ]);
        SchoolDetail::create([
            "school_id" => 7,
            "category_id" => 2,
            "value" => "Terwujudnya lulusan yang berakhlak mulia, kreatif, kompetitif dan mandiri."
        ]);
        SchoolDetail::create([
            "school_id" => 7,
            "category_id" => 3,
            "value" => "Menanamkan akidah salafus shaleh kepada peserta didik; Membina peserta didik untuk beribadah sesuai dengan alquran dan sunnah; Menanamkan akhlak mulia kepada peserta didik dalam keluarga dan masyarakat; Mengembangkan potensi peserta didik dalam ilmu pengetahuan, bahasa, teknologi dan keterampilan; Membekali peserta didik untuk mencapai lulusan yang berstandar nasional; Membekali peserta didik dengan kemandirian personal."
        ]);
        SchoolDetail::create([
            "school_id" => 7,
            "category_id" => 4,
            "value" => "1350000"
        ]);
        SchoolDetail::create([
            "school_id" => 7,
            "category_id" => 5,
            "value" => "16750000"
        ]);
        SchoolDetail::create([
            "school_id" => 7,
            "category_id" => 6,
            "value" => "kemenag_mandiri"
        ]);
        SchoolDetail::create([
            "school_id" => 7,
            "category_id" => 7,
            "value" => "Tahsin, Tahfizh Quran, Pembinaan Akhlak yang intensif, Program Bahasa Asing (Pembiasaan Percakapan Bahasa Arab & Inggris Sehari – hari), Pembinaan Asrama."
        ]);
        SchoolDetail::create([
            "school_id" => 7,
            "category_id" => 8,
            "value" => "Asrama pakai AC, Labor IPA dan Komputer, Lapangan olahraga, Studio mini, Bus operasional."
        ]);
        SchoolDetail::create([
            "school_id" => 7,
            "category_id" => 9,
            "value" => "Pramuka, IT/ Video dan Design Grafis, Penyiaran, Menulis, Basket, Badminton, Voli, Futsal, Panahan, Takraw. "
        ]);

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
