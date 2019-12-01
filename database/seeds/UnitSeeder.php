<?php

use Illuminate\Database\Seeder;
use App\UnitsModel;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      $unit = [

            ['iso_code'=>'VN', 'iso_name'=>'Vehicle', 'iso_description'=>'A self-propelled means of conveyance.'],
            //area
            ['iso_code'=>'CM', 'iso_name'=>'Centimeter', 'iso_description'=>''],
            ['iso_code'=>'MM', 'iso_name'=>'Millimeter', 'iso_description'=>''],
            ['iso_code'=>'M', 'iso_name'=>'Millimeter', 'iso_description'=>''],
            ['iso_code'=>'IN', 'iso_name'=>'Inch', 'iso_description'=>''],
            ['iso_code'=>'YD', 'iso_name'=>'Yard', 'iso_description'=>''],
            ['iso_code'=>'FT', 'iso_name'=>'Foot', 'iso_description'=>''],
            //volume
            ['iso_code'=>'G', 'iso_name'=>'Gram', 'iso_description'=>''],
            ['iso_code'=>'KG', 'iso_name'=>'Kilogram', 'iso_description'=>''],
            ['iso_code'=>'LTR', 'iso_name'=>'Liter', 'iso_description'=>''],
            ['iso_code'=>'LB', 'iso_name'=>'Pound', 'iso_description'=>''],
            ['iso_code'=>'OZ', 'iso_name'=>'Ounce', 'iso_description'=>''],
            //ISO Standards for Packaging
            ['iso_code'=>'AM', 'iso_name'=>'Ampoule, non-protected', 'iso_description'=>''],
            ['iso_code'=>'AP', 'iso_name'=>'Ampoule, protected', 'iso_description'=>''],
            ['iso_code'=>'AV', 'iso_name'=>'Capsule', 'iso_description'=>''],
            ['iso_code'=>'BA', 'iso_name'=>'Barrel', 'iso_description'=>''],
            ['iso_code'=>'BC', 'iso_name'=>'Bottlecrate/Bottlerack', 'iso_description'=>''],
            ['iso_code'=>'BD', 'iso_name'=>'Board', 'iso_description'=>''],
            ['iso_code'=>'BE', 'iso_name'=>'Bundle', 'iso_description'=>''],
            ['iso_code'=>'BG', 'iso_name'=>'Bag', 'iso_description'=>'A receptacle made of flexible material with an open or closed top.'],
            ['iso_code'=>'BH', 'iso_name'=>'Bunch', 'iso_description'=>''],
            ['iso_code'=>'BI', 'iso_name'=>'Bin', 'iso_description'=>''],
            ['iso_code'=>'BJ', 'iso_name'=>'Bucket', 'iso_description'=>''],
            ['iso_code'=>'BK', 'iso_name'=>'Basket', 'iso_description'=>''],
            ['iso_code'=>'BX', 'iso_name'=>'Box', 'iso_description'=>''],
            ['iso_code'=>'CI', 'iso_name'=>'Canister', 'iso_description'=>''],
            ['iso_code'=>'CL', 'iso_name'=>'Coil', 'iso_description'=>''],
            ['iso_code'=>'CN', 'iso_name'=>'Container', 'iso_description'=>''],
            ['iso_code'=>'CQ', 'iso_name'=>'Cartridge', 'iso_description'=>'Package containing a charge such as propelling explosive for firearms or ink toner for a printer.'],
            ['iso_code'=>'CS', 'iso_name'=>'Case', 'iso_description'=>''],
            ['iso_code'=>'CT', 'iso_name'=>'Carton', 'iso_description'=>''],
            ['iso_code'=>'CX', 'iso_name'=>'Can, cylindrical', 'iso_description'=>''],
            ['iso_code'=>'CA', 'iso_name'=>'Can, rectangular', 'iso_description'=>''],
            ['iso_code'=>'CY', 'iso_name'=>'Cylinder', 'iso_description'=>''],
            ['iso_code'=>'CZ', 'iso_name'=>'Canvas', 'iso_description'=>''],
            ['iso_code'=>'DR', 'iso_name'=>'Drum', 'iso_description'=>''],
            ['iso_code'=>'DZ', 'iso_name'=>'Dozen', 'iso_description'=>'12 Items'],
            ['iso_code'=>'EN', 'iso_name'=>'Envelope', 'iso_description'=>''],
            ['iso_code'=>'FL', 'iso_name'=>'Flask', 'iso_description'=>''],
            ['iso_code'=>'FR', 'iso_name'=>'Frame', 'iso_description'=>''],
            ['iso_code'=>'GL', 'iso_name'=>'Container, gallon', 'iso_description'=>'A container with a capacity of one gallon.'],
            ['iso_code'=>'JG', 'iso_name'=>'Jug', 'iso_description'=>''],
            ['iso_code'=>'JR', 'iso_name'=>'Jar', 'iso_description'=>''],
            ['iso_code'=>'PG', 'iso_name'=>'Plate', 'iso_description'=>''],
            ['iso_code'=>'PH', 'iso_name'=>'Pitcher', 'iso_description'=>''],
            ['iso_code'=>'PK', 'iso_name'=>'Package/Packs', 'iso_description'=>'Standard packaging unit.'],
            ['iso_code'=>'PL', 'iso_name'=>'Pail', 'iso_description'=>''],
            ['iso_code'=>'PO', 'iso_name'=>'Pouch', 'iso_description'=>''],
            ['iso_code'=>'PC', 'iso_name'=>'Piece', 'iso_description'=>'A loose or unpacked article.'],
            ['iso_code'=>'PU', 'iso_name'=>'Tray', 'iso_description'=>''],
            ['iso_code'=>'RO', 'iso_name'=>'Roll', 'iso_description'=>''],
            ['iso_code'=>'RM', 'iso_name'=>'Ream', 'iso_description'=>''],
            ['iso_code'=>'SA', 'iso_name'=>'Sack', 'iso_description'=>''],
            ['iso_code'=>'SB', 'iso_name'=>'Slab', 'iso_description'=>''],
            ['iso_code'=>'ST', 'iso_name'=>'Sheet', 'iso_description'=>''],
            ['iso_code'=>'VI', 'iso_name'=>'Vial', 'iso_description'=>''],
            ['iso_code'=>'UN', 'iso_name'=>'Unit', 'iso_description'=>'A type of package composed of a single item or object, not otherwise specified as a unit of transport equipment.'],
            
      ];

      //['iso_code'=>'', 'iso_name'=>'', 'iso_description'=>''],

      foreach ($unit as $key => $units) {
            # code...
            UnitsModel::create($units);
      }
		

    }
}


