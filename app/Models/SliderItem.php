<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model
{
    protected $fillable = ['block_id','image','text','sort_order','caption_bottom'];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }
}
