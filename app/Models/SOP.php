<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SOP extends Model
{
    use HasFactory;
    protected $table = 'sops';
    protected $fillable = [
        'perihal_SOP',
        'klasifikasi',
        'status_SOP',
    ];



    public function status()
    {
        return $this->belongsTo(LetterStatus::class, 'status_SOP', 'id');
    }
    public function classification()
    {
        return $this->belongsTo(Classification::class, 'klasifikasi','code');
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'letter_id','id');
    }


//     public static function createSOP($perihal, $klasifikasi, $status, $lampiran)
// {
//     $sop = self::create([
//         'perihal_SOP' => $perihal,
//         'klasifikasi' => $klasifikasi,
//         'status_SOP' => $status,
//     ]);
//     // $sop->attachments()->create([...]);

//     return $sop;
// }

}
