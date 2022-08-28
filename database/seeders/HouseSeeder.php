<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = SimpleExcelReader::create(storage_path('app/public/property-data.csv'))->getRows();
        $rows->each(function (array $rowProperties) {

            $house = new House(
                [
                    'name' => $rowProperties['Name'],
                    'price' => $rowProperties['Price'],
                    'bedrooms' => $rowProperties['Bedrooms'],
                    'bathrooms' => $rowProperties['Bathrooms'],
                    'storeys' => $rowProperties['Storeys'],
                    'garages' => $rowProperties['Garages'],
                ]
            );
            $house->save();
        });
    }
}
