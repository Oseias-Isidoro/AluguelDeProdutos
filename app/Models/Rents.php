<?php

namespace App\Models;

use App\Scopes\ShopScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find($id)
 * @method static withoutGlobalScope(string $class)
 * @method whereRaw(string $string)
 * @method static create(array $rent_data)
 * @property mixed $status
 */
class Rents extends Model
{
    use SoftDeletes;
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'customer_id',
        'product_id',
        'lease_start_date',
        'lease_end_date',
        'additional_charge',
        'maintenance_cost',
        'damage_rate',
        'status',
        'cost',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function progress()
    {
        return $this->whereRaw('ABS(TIMESTAMPDIFF(MINUTE, lease_start_date,  lease_end_date)) > ')
            ->whereNotIn('status', array('converted', 'expired'))
            ->get();
    }

    public function getCssStatus(): string
    {
        $css_class_status = [
            'in_progress' => 'bg-primary',
            'late' => 'bg-danger',
            'finished' => 'bg-success'
        ];

        return $css_class_status[$this->status];
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
