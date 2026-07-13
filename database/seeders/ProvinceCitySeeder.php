<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\City;

class ProvinceCitySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            'Aceh' => ['Banda Aceh', 'Langsa', 'Lhokseumawe', 'Sabang', 'Meulaboh'],
            'Sumatera Utara' => ['Medan', 'Binjai', 'Pematangsiantar', 'Tebing Tinggi', 'Sibolga'],
            'Sumatera Barat' => ['Padang', 'Bukittinggi', 'Payakumbuh', 'Solok', 'Sawahlunto'],
            'Riau' => ['Pekanbaru', 'Dumai', 'Bengkalis', 'Siak', 'Rokan Hulu'],
            'Kepulauan Riau' => ['Tanjung Pinang', 'Batam', 'Bintan', 'Karimun', 'Natuna'],
            'Jambi' => ['Jambi', 'Sungai Penuh', 'Muaro Jambi', 'Batanghari', 'Bungo'],
            'Sumatera Selatan' => ['Palembang', 'Lubuklinggau', 'Prabumulih', 'Pagar Alam', 'Ogan Ilir'],
            'Bangka Belitung' => ['Pangkal Pinang', 'Belitung', 'Bangka', 'Bangka Barat', 'Belitung Timur'],
            'Bengkulu' => ['Bengkulu', 'Rejang Lebong', 'Kepahiang', 'Seluma', 'Mukomuko'],
            'Lampung' => ['Bandar Lampung', 'Metro', 'Lampung Selatan', 'Lampung Tengah', 'Tulang Bawang'],
            'DKI Jakarta' => ['Jakarta Pusat', 'Jakarta Utara', 'Jakarta Barat', 'Jakarta Selatan', 'Jakarta Timur', 'Kepulauan Seribu'],
            'Banten' => ['Serang', 'Tangerang', 'Tangerang Selatan', 'Cilegon', 'Pandeglang'],
            'Jawa Barat' => ['Bandung', 'Bekasi', 'Bogor', 'Depok', 'Cimahi', 'Sukabumi', 'Cirebon', 'Tasikmalaya', 'Karawang', 'Purwakarta'],
            'Jawa Tengah' => [
                'Demak', 'Kota Semarang', 'Kudus', 'Jepara', 'Pati', 'Kendal', 'Grobogan',
                'Rembang', 'Blora', 'Sragen', 'Kota Surakarta', 'Pekalongan', 'Tegal',
                'Kota Salatiga', 'Boyolali', 'Klaten', 'Wonogiri', 'Karanganyar',
                'Kota Pekalongan', 'Kota Tegal', 'Batang', 'Pemalang', 'Brebes',
                'Purbalingga', 'Banjarnegara', 'Kebumen', 'Purworejo', 'Magelang',
                'Kota Magelang', 'Temanggung', 'Wonosobo', 'Cilacap', 'Banyumas',
            ],
            'DI Yogyakarta' => ['Kota Yogyakarta', 'Sleman', 'Bantul', 'Kulon Progo', 'Gunung Kidul'],
            'Jawa Timur' => ['Surabaya', 'Malang', 'Kediri', 'Madiun', 'Blitar', 'Mojokerto', 'Sidoarjo', 'Jember', 'Banyuwangi', 'Gresik'],
            'Bali' => ['Denpasar', 'Badung', 'Gianyar', 'Tabanan', 'Buleleng'],
            'Nusa Tenggara Barat' => ['Mataram', 'Bima', 'Lombok Barat', 'Lombok Timur', 'Sumbawa'],
            'Nusa Tenggara Timur' => ['Kupang', 'Ende', 'Sikka', 'Manggarai', 'Sumba Timur'],
            'Kalimantan Barat' => ['Pontianak', 'Singkawang', 'Sambas', 'Ketapang', 'Sintang'],
            'Kalimantan Tengah' => ['Palangka Raya', 'Kotawaringin Barat', 'Kotawaringin Timur', 'Kapuas', 'Barito Selatan'],
            'Kalimantan Selatan' => ['Banjarmasin', 'Banjarbaru', 'Banjar', 'Tanah Laut', 'Hulu Sungai Selatan'],
            'Kalimantan Timur' => ['Samarinda', 'Balikpapan', 'Bontang', 'Kutai Kartanegara', 'Berau'],
            'Kalimantan Utara' => ['Tanjung Selor', 'Tarakan', 'Bulungan', 'Malinau', 'Nunukan'],
            'Sulawesi Utara' => ['Manado', 'Bitung', 'Tomohon', 'Kotamobagu', 'Minahasa'],
            'Gorontalo' => ['Gorontalo', 'Boalemo', 'Bone Bolango', 'Pohuwato', 'Gorontalo Utara'],
            'Sulawesi Tengah' => ['Palu', 'Poso', 'Donggala', 'Banggai', 'Toli-Toli'],
            'Sulawesi Barat' => ['Mamuju', 'Majene', 'Polewali Mandar', 'Mamasa', 'Pasangkayu'],
            'Sulawesi Selatan' => ['Makassar', 'Parepare', 'Palopo', 'Gowa', 'Bone'],
            'Sulawesi Tenggara' => ['Kendari', 'Baubau', 'Konawe', 'Muna', 'Kolaka'],
            'Maluku' => ['Ambon', 'Tual', 'Maluku Tengah', 'Buru', 'Kepulauan Aru'],
            'Maluku Utara' => ['Ternate', 'Tidore Kepulauan', 'Halmahera Barat', 'Halmahera Utara', 'Halmahera Selatan'],
            'Papua' => ['Jayapura', 'Biak Numfor', 'Jayawijaya', 'Merauke', 'Nabire'],
            'Papua Barat' => ['Manokwari', 'Sorong', 'Fakfak', 'Kaimana', 'Teluk Bintuni'],
        ];

        foreach ($data as $provinceName => $cities) {
            $province = Province::firstOrCreate(['name' => $provinceName]);

            $cityRows = array_map(function ($cityName) use ($province) {
                return [
                    'province_id' => $province->id,
                    'name' => $cityName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $cities);

            City::where('province_id', $province->id)->delete();
            City::insert($cityRows);
        }
    }
}
