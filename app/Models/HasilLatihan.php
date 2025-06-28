<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilLatihan extends Model
{
        protected $fillable = [
        'schedule_id', 'tanggal_lahir', 'jenis_kelamin',
        'berat', 'tinggi', 'otot_kanan', 'otot_kiri',
        'repitisi', 'waktu_firebase'
    ];
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
