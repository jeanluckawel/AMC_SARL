<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestAttachment extends Model
{
    protected $fillable = [
        'request_id',
        'uploaded_by',
        'original_name',
        'file_name',
        'file_path',
        'disk',
        'mime_type',
        'file_size',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(
            RequestModel::class,
            'request_id'
        );
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'uploaded_by'
        );
    }
}
