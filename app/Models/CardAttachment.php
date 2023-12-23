<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardAttachment extends Model
{
    use HasFactory;

    protected $table = 'card_attachments';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = auth()->check() ? auth()->id() : 1;
            $model->updated_by = auth()->check() ? auth()->id() : 1;
        });
        static::saving(function ($model) {
            $model->created_by = auth()->check() ? auth()->id() : 1;
            $model->updated_by = auth()->check() ? auth()->id() : 1;
        });
    }

    public function created_author()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
    public function updated_author()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }
}
