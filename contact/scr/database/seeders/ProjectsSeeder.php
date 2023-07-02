<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Projects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Projects = [
            [
                'name' => 'project1',
                'description' => 'example text',
                'delivery_date' => '2000-01-01 00:00:00',
                'client_id' => '1',
            ],
            [
                'name' => 'project2',
                'description' => 'example text',
                'delivery_date' => '2000-01-01 00:00:00',
                'client_id' => '1',
            ],
            [
                'name' => 'project3',
                'description' => 'example text',
                'delivery_date' => '2000-01-01 00:00:00',
                'client_id' => '2',
            ],

        ];
        foreach ($Projects as $key => $value) {

            Projects::create($value);
        }
    }
}
