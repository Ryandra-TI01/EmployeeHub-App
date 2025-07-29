<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'divisions';
    protected $guarded = ['id'];
    protected static function boot()
    {
        parent::boot();
        static::creating(fn($model) => $model->id = (string) \Illuminate\Support\Str::uuid());
    }
    protected $casts = [
        'id' => 'string',
    ];
    public $keyType = 'string';
    public function employees()
    {
        return $this->hasMany(Employee::class, 'division_id');
    }
}
