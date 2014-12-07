<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class UnitsTableSeeder extends Seeder {

    public function run() {
        $units = [
            [
                "symbol" => "PA88",
                "name" => "An ninh chính trị tư tưởng",
            ],
            [
                "symbol" => "PA92",
                "name" => "xxxxxxxxx",
            ],
            [
                "symbol" => "PC45",
                "name" => "Phòng chống mà túy",
            ]
        ];
        foreach ($units as $unit) {

            Unit::create($unit);
        }
    }

}
