<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reddit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'title', 'image_url'];

    // Haciendo relación a la base de datos ya que un reddit puede tener varios subreddits
    public function subreddits(){
        return $this->hasMany( Subreddit::class );
    }
}
