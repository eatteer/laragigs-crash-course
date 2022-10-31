<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'title',
        'location',
        'email',
        'website',
        'logo',
        'tags',
        'description',
        'user_id'
    ];

    public function scopeFilter($query, array $filters)
    {
        [
            'tag' => $tag,
            'search' => $search
        ] = $filters;

        if ($tag) {
            $query->where('tags', 'like', "%$tag%");
        }

        if ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('company', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('tags', 'like', "%$search%")
                ->orWhere('location', 'like', "%$search%");
        }
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
