<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PurposesTableSeeder extends Seeder {

    public function run() {
        $purposes = [
            [
                "content" => "list",
            ],
            [
                 "content" => "email",
            ],
            [
                 "content" => "xmctb",
            ],
            [
                 "content" => "giám sát",
            ],
        ];
        foreach ($purposes as $purpose) {

            Purpose::create($purpose);
        }
    }

}
