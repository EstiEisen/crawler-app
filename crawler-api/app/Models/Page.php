<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['base_url_id', 'url', 'content'];

    public function baseUrl()
    {
        return $this->belongsTo(BaseUrl::class);
    }
}
