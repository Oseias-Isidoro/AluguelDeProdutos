<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $customer_id
 * @property mixed $zipcode
 * @property mixed $street
 * @property mixed $district
 * @property mixed $number
 * @property mixed $adjunct
 * @property mixed $city
 * @property mixed $state
 * @property mixed $country
 * @method static create(array $customer_addresse_data)
 */
class CustomerAddresses extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'customer_id',
        "zipcode",
        "street",
        "number",
        "district",
        "city",
        "state",
        "country",
    ];
}
