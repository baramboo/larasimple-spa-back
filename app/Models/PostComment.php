<?php

namespace App\Models;

use App\Core\Models\CoreModel;
use App\Core\Traits\DateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PostComment
 *
 * @package App\Models
 * @property int $id
 * @property int $post_id Post
 * @property int $author_id Comment Author
 * @property string $comment Comment
 * @property string $created_at
 * @property string $updated_at
 * @property-read \App\Models\User $author
 * @property-read \App\Models\Post $post
 * @method static \Database\Factories\PostCommentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostComment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostComment extends CoreModel
{
    use HasFactory;
    use DateTrait;

    protected $fillable = [
        'post_id_',
        'author_id',
        'comment',
        'created_at'
    ];

    protected $hidden = [
        'updated_at'
    ];

    /**
     * @return BelongsTo
     */
    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public static function attributesAliases(): array
    {
        return [
            // attributes with aliases
        ];
    }
}