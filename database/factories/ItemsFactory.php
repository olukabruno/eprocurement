<?php

use Faker\Generator as Faker;
use App\PurchaseRequestItemModel;

$factory->define(App\PurchaseRequestItemModel::class, function (Faker $faker) {

	$qty = $faker->numberBetween($min = 1, $max = 10);
	$cpu = $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10000);

    return [
        //
        'pr_qty' => $qty,
        'pr_unit' => 'PC',
        'pr_description' => strtoupper($faker->word),
        'pr_cost_per_unit'=> $cpu,
        'pr_estimated_cost'=> $qty * $cpu,
        'pr_form_number'=> 'PR-ICT-2018-01-0000'
    ];
});
