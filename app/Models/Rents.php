<?php

namespace App\Models;

use App\Scopes\ShopScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rents extends Model
{
    use SoftDeletes;
    public $timestamps = true;

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

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function progress()
    {
        return $this->whereRaw('ABS(TIMESTAMPDIFF(MINUTE, lease_start_date,  lease_end_date)) > ')
            ->where('status', '<>', 'converted')
            ->where('status', '<>', 'expired')
            ->get();
    }

    public function getCssStatus()
    {
        switch ($this->status)
        {
            case 'in_progress':
                return 'bg-primary';
                break;
            case 'late':
                return 'bg-danger';
                break;
            case 'finished':
                return 'bg-success';
                break;
        }
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
