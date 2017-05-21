<?php

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Model;

class ForumSection extends Model
{
    protected $table = 'forums_sections';
    protected $fillable = ['title', 'description'];
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forums() {
        return $this->hasMany(Forum::class, 'forum_section_id');
    }
}
