<?php

namespace App\Database\Seeds;

use App\Models\AdminModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('admin')->insert($this->createAdmin());
        // $this->call('AdminSeeder');
    }
    
    private function createAdmin()
    {
        return [
            "firstname" => "Ashvin",
            "lastname"  => "Kanzariya",
            'email'     => "ashvin@gmail.com",
            'password'  => password_hash('12345678',PASSWORD_DEFAULT),
        ];
    }
}
