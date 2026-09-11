<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staticSectors = [
            [
                'sector_number' => 1,
                'name' => 'Manufacturing',
                'parent_sector_number' => null
            ],
            [
                'sector_number' => 19,
                'name' => 'Construction materials',
                'parent_sector_number' => 1
            ],
            [
                'sector_number' => 18,
                'name' => 'Electronics and Optics',
                'parent_sector_number' => 1
            ],
            [
                'sector_number' => 6,
                'name' => 'Food and Beverage',
                'parent_sector_number' => 1
            ],
            [
                'sector_number' => 342,
                'name' => 'Bakery & confectionery products',
                'parent_sector_number' => 6
            ],
            [
                'sector_number' => 43,
                'name' => 'Beverages',
                'parent_sector_number' => 6
            ],
            [
                'sector_number' => 42,
                'name' => 'Fish & fish products',
                'parent_sector_number' => 6
            ],
            [
                'sector_number' => 40,
                'name' => 'Meat & meat products',
                'parent_sector_number' => 6
            ],
            [
                'sector_number' => 39,
                'name' => 'Milk & dairy products',
                'parent_sector_number' => 6
            ],
            [
                'sector_number' => 437,
                'name' => 'Other',
                'parent_sector_number' => 6
            ],
            [
                'sector_number' => 378,
                'name' => 'Sweets & snack food',
                'parent_sector_number' => 6
            ],
            [
                'sector_number' => 13,
                'name' => 'Furniture',
                'parent_sector_number' => 1
            ],
            [
                'sector_number' => 389,
                'name' => 'Bathroom/sauna',
                'parent_sector_number' => 13
            ],
            [
                'sector_number' => 385,
                'name' => 'Bedroom',
                'parent_sector_number' => 13
            ],
            [
                'sector_number' => 390,
                'name' => "Children's room",
                'parent_sector_number' => 13
            ],
            [
                'sector_number' => 98,
                'name' => 'Kitchen',
                'parent_sector_number' => 13
            ],
            [
                'sector_number' => 101,
                'name' => 'Living room',
                'parent_sector_number' => 13
            ],
            [
                'sector_number' => 392,
                'name' => 'Office',
                'parent_sector_number' => 13
            ],
            [
                'sector_number' => 394,
                'name' => 'Other (Furniture)',
                'parent_sector_number' => 13
            ],
            [
                'sector_number' => 341,
                'name' => 'Outdoor',
                'parent_sector_number' => 13
            ],
            [
                'sector_number' => 99,
                'name' => 'Project furniture',
                'parent_sector_number' => 13
            ],
            [
                'sector_number' => 12,
                'name' => 'Machinery',
                'parent_sector_number' => 1
            ],
            [
                'sector_number' => 94,
                'name' => 'Machinery components',
                'parent_sector_number' => 12
            ],
            [
                'sector_number' => 91,
                'name' => 'Machinery equipment/tools',
                'parent_sector_number' => 12
            ],
            [
                'sector_number' => 224,
                'name' => 'Manufacture of machinery ',
                'parent_sector_number' => 12
            ],
            [
                'sector_number' => 97,
                'name' => 'Maritime',
                'parent_sector_number' => 12
            ],
            [
                'sector_number' => 271,
                'name' => 'Aluminium and steel workboats ',
                'parent_sector_number' => 97
            ],
            [
                'sector_number' => 269,
                'name' => 'Boat/Yacht building',
                'parent_sector_number' => 97
            ],
            [
                'sector_number' => 230,
                'name' => 'Ship repair and conversion',
                'parent_sector_number' => 97
            ],
            [
                'sector_number' => 93,
                'name' => 'Metal structures',
                'parent_sector_number' => 12
            ],
            [
                'sector_number' => 508,
                'name' => 'Other',
                'parent_sector_number' => 12
            ],
            [
                'sector_number' => 227,
                'name' => 'Repair and maintenance service',
                'parent_sector_number' => 12
            ],
            [
                'sector_number' => 11,
                'name' => 'Metalworking',
                'parent_sector_number' => 1
            ],
            [
                'sector_number' => 67,
                'name' => 'Construction of metal structures',
                'parent_sector_number' => 11
            ],
            [
                'sector_number' => 263,
                'name' => 'Houses and buildings',
                'parent_sector_number' => 11
            ],
            [
                'sector_number' => 267,
                'name' => 'Metal products',
                'parent_sector_number' => 11
            ],
            [
                'sector_number' => 542,
                'name' => 'Metal works',
                'parent_sector_number' => 11
            ],
            [
                'sector_number' => 75,
                'name' => 'CNC-machining',
                'parent_sector_number' => 542
            ],
            [
                'sector_number' => 62,
                'name' => 'Forgings, Fasteners',
                'parent_sector_number' => 542
            ],
            [
                'sector_number' => 69,
                'name' => 'Gas, Plasma, Laser cutting',
                'parent_sector_number' => 542
            ],
            [
                'sector_number' => 66,
                'name' => 'MIG, TIG, Aluminum welding',
                'parent_sector_number' => 542
            ],
            [
                'sector_number' => 9,
                'name' => 'Plastic and Rubber',
                'parent_sector_number' => 1
            ],
            [
                'sector_number' => 54,
                'name' => 'Packaging',
                'parent_sector_number' => 9
            ],
            [
                'sector_number' => 556,
                'name' => 'Plastic goods',
                'parent_sector_number' => 9
            ],
            [
                'sector_number' => 559,
                'name' => 'Plastic processing technology',
                'parent_sector_number' => 9
            ],
            [
                'sector_number' => 55,
                'name' => 'Blowing',
                'parent_sector_number' => 559
            ],
            [
                'sector_number' => 57,
                'name' => 'Moulding',
                'parent_sector_number' => 559
            ],
            [
                'sector_number' => 53,
                'name' => 'Plastic welding and processing',
                'parent_sector_number' => 559
            ],
            [
                'sector_number' => 560,
                'name' => 'Plastic profiles',
                'parent_sector_number' => 9
            ],
            [
                'sector_number' => 5,
                'name' => 'Printing',
                'parent_sector_number' => 1
            ],
            [
                'sector_number' => 148,
                'name' => 'Advertising',
                'parent_sector_number' => 5
            ],
            [
                'sector_number' => 150,
                'name' => 'Book/Periodicals printing',
                'parent_sector_number' => 5
            ],
            [
                'sector_number' => 145,
                'name' => 'Labelling and packaging printing',
                'parent_sector_number' => 5
            ],
            [
                'sector_number' => 7,
                'name' => 'Textile and Clothing',
                'parent_sector_number' => 1
            ],
            [
                'sector_number' => 44,
                'name' => 'Clothing',
                'parent_sector_number' => 7
            ],
            [
                'sector_number' => 45,
                'name' => 'Textile',
                'parent_sector_number' => 7
            ],
            [
                'sector_number' => 8,
                'name' => 'Wood',
                'parent_sector_number' => 1
            ],
            [
                'sector_number' => 337,
                'name' => 'Other (Wood)',
                'parent_sector_number' => 8
            ],
            [
                'sector_number' => 51,
                'name' => 'Wooden building materials',
                'parent_sector_number' => 8
            ],
            [
                'sector_number' => 47,
                'name' => 'Wooden houses',
                'parent_sector_number' => 8
            ],
            [
                'sector_number' => 3,
                'name' => 'Other',
                'parent_sector_number' => null
            ],
            [
                'sector_number' => 37,
                'name' => 'Creative industries',
                'parent_sector_number' => 3
            ],
            [
                'sector_number' => 29,
                'name' => 'Energy technology',
                'parent_sector_number' => 3
            ],
            [
                'sector_number' => 33,
                'name' => 'Enviornment',
                'parent_sector_number' => 3
            ],
            [
                'sector_number' => 2,
                'name' => 'Service',
                'parent_sector_number' => null
            ],
            [
                'sector_number' => 25,
                'name' => 'Business services',
                'parent_sector_number' => 2
            ],
            [
                'sector_number' => 35,
                'name' => 'Engineering',
                'parent_sector_number' => 2
            ],
            [
                'sector_number' => 28,
                'name' => 'Information Technology and Telecommunications',
                'parent_sector_number' => 2
            ],
            [
                'sector_number' => 581,
                'name' => 'Data processing, Web portals, E-marketing',
                'parent_sector_number' => 28
            ],
            [
                'sector_number' => 576,
                'name' => 'Programming, Consultancy',
                'parent_sector_number' => 28
            ],
            [
                'sector_number' => 121,
                'name' => 'Software, Hardware',
                'parent_sector_number' => 28
            ],
            [
                'sector_number' => 122,
                'name' => 'Telecommunications',
                'parent_sector_number' => 28
            ],
            [
                'sector_number' => 22,
                'name' => 'Tourism',
                'parent_sector_number' => 2
            ],
            [
                'sector_number' => 141,
                'name' => 'Translation services',
                'parent_sector_number' => 2
            ],
            [
                'sector_number' => 21,
                'name' => 'Transport and Logistics',
                'parent_sector_number' => 2
            ],
            [
                'sector_number' => 111,
                'name' => 'Air',
                'parent_sector_number' => 21
            ],
            [
                'sector_number' => 114,
                'name' => 'Rail',
                'parent_sector_number' => 21
            ],
            [
                'sector_number' => 112,
                'name' => 'Road',
                'parent_sector_number' => 21
            ],
            [
                'sector_number' => 113,
                'name' => 'Water',
                'parent_sector_number' => 21
            ],
        ];

        // Get current timestamp
        $now = now();

        // Add current timestamps to the data before inserting into the database
        $staticSectors = array_map(function ($sector) use ($now) {
            return array_merge($sector, [
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }, $staticSectors);

        Sector::insert($staticSectors);
    }
}
