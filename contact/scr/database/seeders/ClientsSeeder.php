<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clients;


class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Clients = [
            [
                'id' => '1',
                'name' => 'Ministry of Magic',
                'contact_name_1'=> 'Muc1',
                'contact_name_2'=> 'Muc2',
                'email_1'=> 'muc@gmail.com',
                'email_2'=> 'muc@gmail.com',
                'phone_1'=> '987654321',
                'phone_2'=> '987654321',
                'description'=> 'text',
                'contract'=> 'file',
                'notes'=> 'text',
                'status'=> 'done',

            ],
            [
                'id' => '2',
                'name' => 'Ministry of Magic',
                'contact_name_1'=> 'Tuc1',
                'contact_name_2'=> 'Tuc2',
                'email_1'=> 'tuc@gmail.com',
                'email_2'=> 'tuc@gmail.com',
                'phone_1'=> '987654321',
                'phone_2'=> '987654321',
                'description'=> 'text',
                'contract'=> 'file',
                'notes'=> 'text',
                'status'=> 'done',

            ],
           
        ];
        foreach ($Clients as $key => $value) {

            Clients::create($value);
        }
    }
}
