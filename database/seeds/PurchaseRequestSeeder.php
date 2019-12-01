<?php

use Illuminate\Database\Seeder;
use App\PurchaseRequestModel;

class PurchaseRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PurchaseRequestModel::create([
            'pr_unique' => "ICT180100",
            'pr_form_no' =>"PR-ICT-2018-01-0000",
            'department' =>"ADM",
            'section' =>"ICT",
            'purpose' => "SAMPLE ICT PURCHASE REQUEST",
            'requestor_name'=>"Germie O. Deang",
            'requestor_position'=>"Information Technology Officer II",
            'supplier_type'=>"Canvass",
            'budget_alloc'=>"4048350.00",     
            'status'=>"Pending",
            'is_supplemental'=>"0",
            'created_by'=>1,


		]);
    }
}
