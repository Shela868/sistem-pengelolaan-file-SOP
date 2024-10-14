<?php

namespace App\Models;

use App\Enums\Config as ConfigEnum;
use App\Enums\LetterType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Outputattachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'filename',
        'extension',
        'output_id',
        'user_id',
    ];

    protected $appends = [
        'path_url',
    ];

    /**
     * @return string
     */
    public function getPathUrlAttribute(): string {
        if (!is_null($this->path)) {
            return $this->path;
        }

        return asset('storage/attachments/' . $this->filename);
    }



    public function scopeRender($query, $search)
    {
        return $query
            ->with(['letter'])
            ->search($search)
            ->latest('created_at')
            ->paginate(Config::getValueByCode(ConfigEnum::PAGE_SIZE))
            ->appends([
                'search' => $search,
            ]);
    }

    /**
     * @return BelongsTo
     */

    public function output_sop()
    {
        return $this->belongsTo(output_sop::class);
    }
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
