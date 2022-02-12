<?php

namespace App\Models;

use App\Core\Models\CoreModel;
use App\Core\Traits\DateTrait;
use App\Models\QueryBuilders\PostQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property int $author_id Author ID
 * @property string $title Title
 * @property string $description Description
 * @property string $created_at
 * @property string $updated_at
 * @property-read \App\Models\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostComment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostComment[] $recentComments
 * @property-read int|null $recent_comments_count
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCommentAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends CoreModel
{
    use HasFactory;
    use DateTrait;

    protected $fillable = [
        'author_id',
        'title',
        'description',
        'created_at'
    ];

    protected $hidden = [

    ];


    public static function attributesAliases(): array
    {
        return [
            // attributes with aliases
            'whereCommentAuthorId' => 'byCommentAuthor',
        ];
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(PostComment::class, 'post_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function recentComments(): HasMany
    {
        return $this->hasMany(PostComment::class, 'post_id', 'id')
            ->orderBy('id', 'DESC')
            ->limit(config('paginator.default_related_resents'));
    }


}
