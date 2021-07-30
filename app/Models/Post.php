<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $subject
 * @property string $content
 * @property boolean $is_top
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class Post extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'content', 'user_id', 'category_id', 'is_top', 'parent_id', 'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'subject' => 'string', 'content' => 'string', 'is_top' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected $appends = ['comment_amount'];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCommentAmountAttribute()
    {
        return Post::whereParentId($this->id)->count();
    }
}
