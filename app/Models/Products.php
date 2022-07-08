<?php

namespace App\Models;

use App\Scopes\ShopScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $name
 * @property int|mixed|string|null $user_id
 * @property mixed $price
 * @property mixed $inventory
 * @method static find($id)
 */
class Products extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'inventory',
        'img_path'
    ];

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
