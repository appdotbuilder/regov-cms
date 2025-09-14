<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\GalleryItem
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $type
 * @property string $file_path
 * @property string|null $thumbnail
 * @property string|null $alt_text
 * @property string $status
 * @property int $uploaded_by
 * @property int|null $department_id
 * @property int $views_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\User $uploader
 * @property-read \App\Models\Department|null $department
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem active()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem photos()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem videos()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereAltText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereUploadedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryItem whereViewsCount($value)
 * @method static \Database\Factories\GalleryItemFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class GalleryItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'file_path',
        'thumbnail',
        'alt_text',
        'status',
        'uploaded_by',
        'department_id',
        'views_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'views_count' => 'integer',
    ];

    /**
     * Scope a query to only include active items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include photos.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePhotos($query)
    {
        return $query->where('type', 'photo');
    }

    /**
     * Scope a query to only include videos.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    /**
     * Get the user who uploaded this item.
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get the department this item belongs to.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}