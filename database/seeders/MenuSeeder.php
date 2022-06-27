<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Bluemmb\Faker\PicsumPhotosProvider as PicsumPhotosProvider;

use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        $faker->addProvider(new PicsumPhotosProvider($faker));

        for ($i = 0; $i < 100; $i++) {
            $type = $faker->randomElement(['Makanan', 'Minuman']);

            if ($type == 'Makanan') {
                $image = 'food';
            } else {
                $image = 'drink';
            }

            Menu::create([
                'type' => $type,
                'name' => $faker->words(3, true),
                'detail' => $faker->sentences(3, true),
                'price' => $faker->randomNumber(5, true),
                'image' => $faker->imageUrl(640, 480, $image),
            ]);
        }
    }
}
