<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasSlug;

    protected $fillable = [
        // 'image',
        'title',
        'slug',
        'content',
        'category_id',
        'user_id',
        'published_at',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        if (! $this->canGenerateImageConversions()) {
            return;
        }

        $this
            ->addMediaConversion('preview')
            ->width(400);

        $this
            ->addMediaConversion('large')
            ->width(1200);
    }

    

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function claps()
    {
        return $this->hasMany(Claps::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function readTime()
    {
        $words = str_word_count($this->content);

        return ceil($words / 200);
    }

    public function createdAt()
    {
        return $this->created_at->format('M d, Y');
    }

    public function imageUrl($conversionName = '')
    {
        if ($media = $this->getFirstMedia('default')) {
            return $conversionName
                ? $media->getAvailableUrl([$conversionName])
                : $media->getUrl();
        }

        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, '/')) {
            return $this->image;
        }

        return Storage::disk('public')->url($this->image);
    }

    protected function canGenerateImageConversions(): bool
    {
        return match (config('media-library.image_driver', 'gd')) {
            'gd' => function_exists('imagecreatefromstring'),
            'imagick' => extension_loaded('imagick'),
            'vips' => extension_loaded('vips'),
            default => false,
        };
    }
}
