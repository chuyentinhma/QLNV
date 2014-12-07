<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserSeeder
 *
 * @author TNT
 */
class UserSeeder  extends DatabaseSeeder{
    public function run() {
        $users = [
            [
                "username" => "admin",
                "password" => Hash::make("123456"),
                "email" => "thuatnt2@gmail.com"
                
            ],
            [
                "username" => "thuatnt",
                "password" => Hash::make("123456"),
                "email" => "thuatnt2@gmail.com"
                
            ]
        ];
        foreach ($users as $user) {
            
            User::create($user);
        }
    }
}
