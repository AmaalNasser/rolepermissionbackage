<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\TicketsViewController;
use App\Models\Complains;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Complains = [

            [
                'id' => '1',
                'client_id' => '2',
                'project_id' => '3',
                'email' => 'amaal@gmail.com',
                'complain_category_id' => '1',
                'details' => 'Done',
                'file1' => 'file1',
                'file2' => 'file2',
                'file3' => 'file3',
                'file4' => 'file4',
                'status' => 'Close',
                'updated_by' => '1',
                'created_by' => '1',
                'deleted_by' => '1',
                'closed_by' => '1',
                'priority' => 'High',
                'complain_subject' => 'subject 3',

            ],
            [
                'id' => '2',
                'client_id' => '3',
                'project_id' => '1',
                'email' => 'ahamad@gmail.com',
                'complain_category_id' => '2',
                'details' => 'Done',
                'file1' => 'file1',
                'file2' => 'file2',
                'file3' => 'file3',
                'file4' => 'file4',
                'status' => 'Close',
                'updated_by' => '1',
                'created_by' => '1',
                'deleted_by' => '1',
                'closed_by' => '1',
                'priority' => 'Normal',
                'complain_subject' => 'subject 1',


            ],
            [
                'id' => '3',
                'client_id' => '2',
                'project_id' => '1',
                'email' => 'nasser@gmail.com',
                'complain_category_id' => '2',
                'details' => 'Done',
                'file1' => 'file1',
                'file2' => 'file2',
                'file3' => 'file3',
                'file4' => 'file4',
                'status' => 'close',
                'updated_by' => '1',
                'created_by' => '1',
                'deleted_by' => '1',
                'closed_by' => '1',
                'priority' => 'Low',
                'complain_subject' => 'subject 2',

            ],

        ];

        foreach ($Complains as $key => $value) {

            Complains::create($value);
        }

        Complains::factory()->count(20)->create();
    }
}
