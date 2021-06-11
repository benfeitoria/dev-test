<?php

namespace App\Architecture\Posts\Models;

use App\Architecture\Categories\Models\Category;
use App\Architecture\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'image_path',
        'title',
        'content',
        'desactived_t',
        'category_id',
        'user_id',
    ];

    protected $dates = ['deleted_at'];

    /**
     * @return BelongsTo
     */
    public function author (): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function category () : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
