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

class Row extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'style', 'sort_order','container_type'];

    protected $casts = [
        'style' => 'array',
    ];

    public function columns()
    {
        return $this->hasMany(Column::class);
    }
}
