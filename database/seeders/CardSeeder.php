<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cards = [
            0 => [
                'name' => 'Card 1',
                'status' => 'To-do',
            ],
            1 => [
                'name' => 'Card 2',
                'status' => 'In Progress',
            ],
            2 => [
                'name' => 'Card 3',
                'status' => 'In Review',
            ],
            3 => [
                'name' => 'Card 4',
                'status' => 'To-do',
            ],
            4 => [
                'name' => 'Card 5',
                'status' => 'Completed',
            ]
        ];

        foreach ($cards as $card) {
            Card::create($card);
        }
    }
}
