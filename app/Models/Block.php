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

class Block extends Model
{
    use HasFactory;

    protected $fillable = ['column_id', 'type', 'content', 'style'];

    protected $casts = [
        'content' => 'array',
        'style' => 'array',
    ];

    public function column()
    {
        return $this->belongsTo(Column::class);
    }
    public function sliderItems()
    {
        return $this->hasMany(SliderItem::class)->orderBy('sort_order');
    }

}
