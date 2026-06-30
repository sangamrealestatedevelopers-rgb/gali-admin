<?php

namespace App\Models;

use App\Models\Concerns\MongoDbDateTimeFix;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class CmsPage extends Eloquent
{
    use HasFactory;
    use HybridRelations;
    use MongoDbDateTimeFix;

    public const PAGE_KEY_TERMS = 'terms_conditions';

    protected $fillable = [
        'page_key',
        'title',
        'body_html',
    ];

    protected $connection = 'mongodb';

    protected $collection = 'comx_cms_pages';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function terms(): ?self
    {
        return static::where('page_key', self::PAGE_KEY_TERMS)->first();
    }
}
