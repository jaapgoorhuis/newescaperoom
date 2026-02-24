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

class ReusableBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'content',
        'style',
        'sliderItems',
    ];

    protected $casts = [
        'style' => 'array',
        'sliderItems' => 'array',
    ];

    public function isSlider(): bool
    {
        return $this->type === 'slider';
    }

    public function getSliderItemsCollection()
    {
        return collect($this->sliderItems ?? []);
    }

}
