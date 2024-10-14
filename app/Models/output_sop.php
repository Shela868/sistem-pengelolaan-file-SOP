<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class output_sop extends Model
{
    use HasFactory;
    protected $table = 'output_sop';
    protected $fillable = [
        'kode',
        'judul',
        'klasifikasi',

    ];

    public function classification()
    {
        return $this->belongsTo(Classification::class, 'klasifikasi','code');
    }
    public function attachments()
    {
        return $this->hasMany(Outputattachment::class, 'output_id','id');
    }
}
