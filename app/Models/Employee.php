<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) \Illuminate\Support\Str::uuid();
        });
    }
    protected $casts = [
        'id' => 'string',
    ];
    public $keyType = 'string';
    public $incrementing = false;
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
