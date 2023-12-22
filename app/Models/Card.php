<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';
    protected $dates = [
        'status_date'
    ];
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = auth()->check() ? auth()->id() : 1;
            $model->updated_by = auth()->check() ? auth()->id() : 1;
            $model->status_date = now()->format('Y-m-d H:i:s');
        });
        static::saving(function ($model) {
            $model->created_by = auth()->check() ? auth()->id() : 1;
            $model->updated_by = auth()->check() ? auth()->id() : 1;
            $model->status_date = now()->format('Y-m-d H:i:s');
        });
    }

    public function createdAuthor()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
    public function updatedAuthor()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}
