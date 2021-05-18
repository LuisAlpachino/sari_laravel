<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'summary',
        'content',
        'fk_news_types',
        'fk_municipalities',
        'fk_status',
        'fk_users',
        ];

    public function notes() {
        return $this->hasMany(Note::class, 'fk_reports');
    }

    public function user() {
        return $this->belongsTo(User::class, 'fk_users');
    }

    public function resources() {
        return $this->hasMany(Resource::class, 'fk_reports');
    }
}
