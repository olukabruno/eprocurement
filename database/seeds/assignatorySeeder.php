<?php

use Illuminate\Database\Seeder;
use App\Assignatory;

class assignatorySeeder extends Seeder
{
    public function run()
    {
        //
        $signatories = [
            [
                    'dept' => "ICT",
                    'name' => "Oluka Bruno sserunkuma",
                    'position' => "Information Technology Officer II",
                    'kind' => "R",
                    'status' => "1",
            ],
            [
                    'dept' => "ICT",
                    'name' => "Nyika Edward",
                    'position' => "Information Technology Officer I",
                    'kind' => "R",
                    'status' => "0",
            ],
            [
                    'dept' => "Administration",
                    'name' => "Charles Semwogerere",
                    'position' => "Stationary Supervisor",
                    'kind' => "A",
                    'status' => "1",
            ],
            [
                    'dept' => "OSP",
                    'name' => "Hon.  Maria Rosario Eufrosina P. Nisce",
                    'position' => "City Councilor",
                    'kind' => "A",
                    'status' => "0",
            ],
            [
                    'dept' => "OCM",
                    'name' => "Hon. Alfredo Pablo R. Ortega",
                    'position' => "City Vice Mayor",
                    'kind' => "A",
                    'status' => "0",
            ],
            [
                    'dept' => "CBO",
                    'name' => "Cleopatra A. Noces",
                    'position' => "City Budget Officer",
                    'kind' => "AA",
                    'status' => "1",
            ],
            [
                    'dept' => "CTO",
                    'name' => "Kizito Innocent",
                    'position' => "System Administrator",
                    'kind' => "C",
                    'status' => "1",
            ]
        ];

        foreach ($signatories as $key => $signatory) {
            assignatory::create($signatory);
        }
    }
}
