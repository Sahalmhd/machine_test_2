<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example data for the items table
        $items = [
            [
                'itemname' => 'Item 1',
                'qty' => 100,
                'price' => 19.99,
                'status' => true
            ],
            [
                'itemname' => 'Item 2',
                'qty' => 50,
                'price' => 29.99,
                'status' => true
            ],
            [
                'itemname' => 'Item 3',
                'qty' => 200,
                'price' => 9.99,
                'status' => true
            ],
            [
                'itemname' => 'Item 4',
                'qty' => 75,
                'price' => 49.99,
                'status' => false
            ],
            [
                'itemname' => 'Item 5',
                'qty' => 150,
                'price' => 24.99,
                'status' => true
            ],
        ];

        // Insert the data into the items table
        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
