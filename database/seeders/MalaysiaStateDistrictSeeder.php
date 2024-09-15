<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MalaysiaStateDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statesAndDistricts = [
            'Federal Territory (Malaysia)' => [
                'Kuala Lumpur',
                'Putrajaya',
                'Labuan',
            ],
            'Johor' => [
                'Batu Pahat',
                'Johor Bahru',
                'Kluang',
                'Kota Tinggi',
                'Kulai',
                'Mersing',
                'Muar',
                'Pontian',
                'Segamat',
                'Tangkak',
            ],
            'Kedah' => [
                'Baling',
                'Bandar Baharu',
                'Kota Setar',
                'Kuala Muda',
                'Kubang Pasu',
                'Kulim',
                'Langkawi',
                'Padang Terap',
                'Pendang',
                'Pokok Sena',
                'Sik',
                'Yan',
            ],
            'Kelantan' => [
                'Bachok',
                'Gua Musang',
                'Jeli',
                'Kota Bharu',
                'Kuala Krai',
                'Machang',
                'Pasir Mas',
                'Pasir Puteh',
                'Tanah Merah',
                'Tumpat',
            ],
            'Malacca' => [
                'Alor Gajah',
                'Jasin',
                'Melaka Tengah',
            ],
            'Negeri Sembilan' => [
                'Jelebu',
                'Jempol',
                'Kuala Pilah',
                'Port Dickson',
                'Rembau',
                'Seremban',
                'Tampin',
            ],
            'Pahang' => [
                'Bentong',
                'Bera',
                'Cameron Highlands',
                'Jerantut',
                'Kuantan',
                'Lipis',
                'Maran',
                'Pekan',
                'Raub',
                'Rompin',
                'Temerloh',
            ],
            'Penang' => [
                'Central Seberang Perai',
                'North Seberang Perai',
                'Northeast Penang Island',
                'South Seberang Perai',
                'Southwest Penang Island',
            ],
            'Perak' => [
                'Bagan Datuk',
                'Batang Padang',
                'Hilir Perak',
                'Hulu Perak',
                'Kampar',
                'Kerian',
                'Kinta',
                'Kuala Kangsar',
                'Larut, Matang and Selama',
                'Manjung',
                'Muallim',
                'Perak Tengah',
            ],
            'Perlis' => ['Perlis'],
            'Selangor' => [
                'Gombak',
                'Hulu Langat',
                'Hulu Selangor',
                'Klang',
                'Kuala Langat',
                'Kuala Selangor',
                'Petaling',
                'Sabak Bernam',
                'Sepang',
            ],
            'Terengganu' => [
                'Besut',
                'Dungun',
                'Hulu Terengganu',
                'Kemaman',
                'Kuala Nerus',
                'Kuala Terengganu',
                'Marang',
                'Setiu',
            ],
            'Sabah' => [
                'Beaufort',
                'Keningau',
                'Kuala Penyu',
                'Nabawan',
                'Sipitang',
                'Tambunan',
                'Tenom',
                'Kota Marudu',
                'Kudat',
                'Pitas',
                'Beluran',
                'Kinabatangan',
                'Sandakan',
                'Telupid',
                'Tongod',
                'Kalabakan',
                'Kunak',
                'Lahad Datu',
                'Semporna',
                'Tawau',
                'Kota Belud',
                'Kota Kinabalu',
                'Papar',
                'Penampang',
                'Putatan',
                'Ranau',
                'Tuaran',
            ],
            'Sarawak' => [
                'Betong',
                'Kabong',
                'Pusa',
                'Saratok',
                'Bintulu',
                'Sebauh',
                'Tatau',
                'Belaga',
                'Kapit',
                'Song',
                'Bukit Mabong',
                'Bau',
                'Kuching',
                'Lundu',
                'Lawas',
                'Limbang',
                'Beluru',
                'Marudi',
                'Miri',
                'Subis',
                'Telang Usan',
                'Dalat',
                'Daro',
                'Matu',
                'Mukah',
                'Tanjung Manis',
                'Asajaya',
                'Samarahan',
                'Simunjan',
                'Julau',
                'Meradong',
                'Pakan',
                'Sarikei',
                'Serian',
                'Tebedu',
                'Kanowit',
                'Sibu',
                'Selangau',
                'Lubok Antu',
                'Sri Aman',
            ],
        ];

        foreach ($statesAndDistricts as $stateName => $districts) {
            $stateId = DB::table('states')->insertGetId([
                'name' => $stateName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($districts as $districtName) {
                // Remove 'District' from the end of the name if it exists
                $cleanedName = Str::endsWith($districtName, ' District')
                    ? Str::beforeLast($districtName, ' District')
                    : $districtName;

                DB::table('districts')->insert([
                    'state_id' => $stateId,
                    'name' => $cleanedName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
