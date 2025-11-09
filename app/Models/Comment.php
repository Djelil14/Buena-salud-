<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
        'parent_id',
        'author_name',
        'author_email',
        'content',
        'approved',
    ];

    protected $casts = [
        'approved' => 'boolean',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // Relation parent (commentaire auquel on répond)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relation enfants (réponses à ce commentaire)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at', 'asc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


