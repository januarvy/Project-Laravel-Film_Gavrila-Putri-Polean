<?php

namespace Database\Seeders;

use App\Models\Cast;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Peran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorrorFilmsSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $genre = Genre::firstOrCreate(['name' => 'Horror']);

            $films = [
                [
                    'title' => 'Resident Evil',
                    'sinopsis' => 'Resident Evil adalah film horor aksi terbaru yang disutradarai oleh Zach Cregger dan ditulis bersama Shay Hatten. Film ini mengikuti kisah Bryan (Austin Abrams), seorang kurir medis muda yang tanpa sengaja terjebak dalam malam mengerikan penuh kekacauan dan harus berjuang bertahan hidup dari kemunculan makhluk-makhluk terinfeksi di Raccoon City.',
                    'year' => 2026,
                    'poster' => 'template/images/resident-evil-2026.png',
                    'cast' => [
                        'Austin Abrams' => [
                            'role' => 'Bryan (Medical Courier)',
                            'bio' => 'Bryan is a young medical courier fighting to survive as a devastating outbreak engulfs Raccoon City.',
                        ],
                        'Zach Cherry' => [
                            'role' => 'Dr. Carl (Umbrella Scientist)',
                            'bio' => 'Dr. Carl is an Umbrella scientist involved in research connected to the Raccoon City outbreak.',
                        ],
                        'Kali Reis' => [
                            'role' => 'Dr. Maxine (Umbrella Enforcer)',
                            'bio' => 'Dr. Maxine is an Umbrella enforcer carrying out the company’s mission during the outbreak.',
                        ],
                        'Paul Walter Hauser' => [
                            'role' => 'Dr. Paul (Umbrella Scientist)',
                            'bio' => 'Dr. Paul is an Umbrella scientist involved in research related to the outbreak.',
                        ],
                    ],
                ],
                [
                    'title' => 'Weapons',
                    'sinopsis' => 'Weapons adalah film horor misteri menegangkan garapan sutradara Zach Cregger yang mengeksplorasi ketegangan psikologis dan teror misterius akibat hilangnya sejumlah anak secara misterius di sebuah kota kecil.',
                    'year' => 2026,
                    'poster' => 'template/images/weapons-2026.png',
                    'cast' => [
                        'Julia Garner' => [
                            'role' => 'Justine Gandy (School Teacher)',
                            'bio' => 'Justine Gandy is a schoolteacher caught in the mystery surrounding the disappearance of children in her town.',
                        ],
                        'Josh Brolin' => [
                            'role' => 'Victim’s Father / Investigator',
                            'bio' => 'He plays a father searching for the truth behind the children’s disappearance.',
                        ],
                        'Alden Ehrenreich' => [
                            'role' => 'Local Investigator',
                            'bio' => 'He plays a local investigator looking into the mysterious events in the small town.',
                        ],
                        'Benedict Wong' => [
                            'role' => 'Community Leader / Town Resident',
                            'bio' => 'He plays a town resident and community leader facing the mystery in his town.',
                        ],
                    ],
                ],
                [
                    'title' => '28 Years Later',
                    'sinopsis' => '28 Years Later adalah film horor pasca-apokaliptik tentang perjuangan bertahan hidup di tengah wabah virus berbahaya yang mengubah manusia menjadi makhluk buas setelah hampir tiga dekade kehancuran peradaban.',
                    'year' => 2025,
                    'poster' => 'template/images/28-years-later.png',
                    'cast' => [
                        'Jodie Comer' => [
                            'role' => 'Mother / Lead Survivor',
                            'bio' => 'She plays a mother fighting to protect her family and survive in the aftermath of the outbreak.',
                        ],
                        'Aaron Taylor-Johnson' => [
                            'role' => 'Member of a Survivor Group',
                            'bio' => 'He plays a member of a group struggling to survive in the post-outbreak world.',
                        ],
                        "Jack O'Connell" => [
                            'role' => 'Young Safe-Zone Protector',
                            'bio' => 'He plays a young man helping protect a safe zone from the threat of the infected.',
                        ],
                        'Ralph Fiennes' => [
                            'role' => 'Senior Doctor in an Isolated Zone',
                            'bio' => 'He plays a senior doctor caring for survivors in an isolated zone.',
                        ],
                    ],
                ],
            ];

            foreach ($films as $filmData) {
                $castRoles = $filmData['cast'];
                unset($filmData['cast']);

                $film = Film::updateOrCreate(
                    ['title' => $filmData['title']],
                    [...$filmData, 'genre_id' => $genre->id]
                );

                foreach ($castRoles as $name => $castDetails) {
                    $cast = Cast::firstOrCreate(
                        ['name' => $name],
                        ['age' => 0, 'bio' => $castDetails['bio']]
                    );

                    if ($cast->bio !== $castDetails['bio']) {
                        $cast->update(['bio' => $castDetails['bio']]);
                    }

                    Peran::updateOrCreate(
                        ['film_id' => $film->id, 'cast_id' => $cast->id],
                        ['actor' => $castDetails['role']]
                    );
                }
            }
        });
    }
}
