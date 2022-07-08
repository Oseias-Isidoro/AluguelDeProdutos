<?php

namespace App\Models;

use App\Scopes\ShopScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $string, int|string|null $id)
 * @method static create(array $customer_data)
 * @method static orderBy(string $string, string $string1)
 * @property mixed $last_name
 * @property mixed $first_name
 * @property int|mixed|string|null $user_id
 * @property mixed $email
 * @property mixed $document
 * @property mixed $phone_number
 * @property mixed $id
 */

class Customers extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'email',
        'first_name',
        'last_name',
        'document',
        'phone_number'
    ];

    public function addresses(): HasOne
    {
        return $this->hasOne(CustomerAddresses::class, 'customer_id');
    }

    public function getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new ShopScope());
    }
}
