<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rents extends Model
{
    use SoftDeletes;
    public $timestamps = true;

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
}
