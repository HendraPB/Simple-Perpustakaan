<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Wl.7FlWtbvrvJSIvmfPeN.yNQIAmEnVsuyRbqqcQuLmmdppXAXJJ6',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2020-08-05 00:00:00',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 1,
                'name' => 'Petugas',
                'email' => 'petugas@mail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Yki0FKomFZQdUuSlpil50eb9xlt5L.NIAfoFea9Rj26bHhdLRRU2K',
                'remember_token' => NULL,
                'created_at' => '2020-07-24 23:01:18',
                'updated_at' => '2020-07-24 23:01:18',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'role_id' => 2,
                'name' => 'Hendra',
                'email' => 'hendra@mail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$VGPS.7Xpoyqpq4d/3Onl8uV0g2SY40cNjL7iX3gWYleDpbD/.V2MC',
                'remember_token' => NULL,
                'created_at' => '2020-07-24 23:41:35',
                'updated_at' => '2020-07-24 23:41:35',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 6,
                'role_id' => 2,
                'name' => 'Rahmi',
                'email' => 'rahmi@mail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$h6nMuFX5BOltJpzpnTA7ceeVmdbynfugOW5NJ0H1On0FwXd1hRwDC',
                'remember_token' => NULL,
                'created_at' => '2020-07-24 23:42:45',
                'updated_at' => '2020-07-24 23:54:02',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}