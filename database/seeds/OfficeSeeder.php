<?php

use Illuminate\Database\Seeder;
use App\Office;

class OfficeSeeder extends Seeder
{
    public function run()
    {
        //
        $offices = [
        [
            'iso_code' => "BFP",
            'office_name' => "Bureau of Fire Protection",
        ],
        [
            'iso_code' => "DILG",
            'office_name' => "City Department of Interior and Local Government",
        ],
        [
            'iso_code' => "EEM",
            'office_name' => "City Market Office",
        ],
        [
            'iso_code' => "GEO",
            'office_name' => "Geography Office",
        ],
        [
            'iso_code' => "COMELEC",
            'office_name' => "Commission on Elections",
        ],

        [
            'iso_code' => "COA",
            'office_name' => "Commision on Audit",
        ],
        [
            'iso_code' => "MTCCB1",
            'office_name' => "Court Branch 1",
        ],

        [
            'iso_code' => "MTCCB2",
            'office_name' => "Court Branch 2",
        ],
        [
            'iso_code' => "DEPED",
            'office_name' => "Department of Education",
        ],
        [
            'iso_code' => "ELEC",
            'office_name' => "Electrical Office",
        ],
        [
            'iso_code' => "EAS",
            'office_name' => "Engineering and Architectural Services",
        ],
        [
            'iso_code' => "HRM",
            'office_name' => "Human Resource Management Office",
        ],
        [
            'iso_code' => "IDS",
            'office_name' => "Information Dissemination Section",
        ],
        [
            'iso_code' => "ICT",
            'office_name' => "Information Technology Section",
        ],
        [
            'iso_code' => "LUSCM",
            'office_name' => "La Union Science Centrum and Museum",
        ],
        [
            'iso_code' => "LNMB",
            'office_name' => "Liga ng mga Barangay",
        ],
        [
            'iso_code' => "LEBDO",
            'office_name' => "Local Economic, Business and Dev't Office",
        ],
        [
            'iso_code' => "OSM",
            'office_name' => "Office for Strategy Management",
        ],
        [
            'iso_code' => "ACA",
            'office_name' => "Office of the City Accountant",
        ],
        [
            'iso_code' => "ADM",
            'office_name' => "Office of the City Administrator",
        ],
        [
            'iso_code' => "AGR",
            'office_name' => "Office of the City Agriculturist",
        ],
        [
            'iso_code' => "OCA",
            'office_name' => "Office of the City Assesor",
        ],
        [
            'iso_code' => "CBO",
            'office_name' => "Office of the City Budget Officer",
        ],
        [
            'iso_code' => "ENR",
            'office_name' => "Office of the City Environment and Natural Resources Officer",
        ],
        [
            'iso_code' => "GSO",
            'office_name' => "Office of the City General Sercices Officer",
        ],
        [
            'iso_code' => "CHO",
            'office_name' => "Office of the City Health Officer",
        ],
        [
            'iso_code' => "CLO",
            'office_name' => "Office of the City Legal Officer",
        ],
        [
            'iso_code' => "LIB",
            'office_name' => "Librarian Office",
        ],
        [
            'iso_code' => "OCM",
            'office_name' => "Office of the City Mayor",
        ],
        [
            'iso_code' => "PDO",
            'office_name' => "Office of the City Planning and Development Coordinator",
        ],
        [
            'iso_code' => "REG",
            'office_name' => "Office of the City Registrar",
        ],
        [
            'iso_code' => "SWD",
            'office_name' => "Office of the Social Welfare and Development Officer",
        ],
        [
            'iso_code' => "CTO",
            'office_name' => "Office of the City Treasurer",
        ],
        [
            'iso_code' => "CVO",
            'office_name' => "Office of the City Veterenarian",
        ],
        [
            'iso_code' => "OCVM",
            'office_name' => "Office of the City Vice-Mayor",
        ],
        [
            'iso_code' => "OPS",
            'office_name' => "Office of the Public Safety",
        ],
        [
            'iso_code' => "OSP",
            'office_name' => "Office of the Sangguniang Panlungsod",
        ],
        [
            'iso_code' => "OSSP",
            'office_name' => "Office of the Secretary to the Sangguniang Panlungsod",
        ],
        [
            'iso_code' => "OSCA",
            'office_name' => "Office of the Senior Citizen"
        ],
        [
            'iso_code' => "PNP",
            'office_name' => "Philippine National Police"
        ],
        [
            'iso_code' => "PACU",
            'office_name' => "Public Assistance and Complaints Unit"
        ],
    ];

        foreach ($offices as $key => $office) {
            Office::create($office);
        }
    }
}
