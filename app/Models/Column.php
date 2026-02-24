<?php

namespace App\Models;

// use Illuminate\Contracts\auth\MustVerifyEmail;
use App\Output\Concerns\InteractsWithSymbols;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Column extends Model
{
    use HasFactory;

    protected $fillable = ['row_id', 'bootstrap_class', 'style'];

    protected $casts = [
        'style' => 'array',
    ];

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function row()
    {
        return $this->belongsTo(Row::class);
    }
}
