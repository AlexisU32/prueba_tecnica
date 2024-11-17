<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subreddit extends Model
{
    use HasFactory;

    protected $fillable = ['reddit_id', 'display_name', 'header_name', 'banner_img', 'submit_text_html', 'subscribers'];

    public function reddit(){
        return $this->belongsTo( Reddit::class );
    }
}
