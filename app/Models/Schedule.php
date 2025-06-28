<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['pengawas_id', 'atlet_id', 'day', 'time', 'type'];

    public function pengawas()
    {
        return $this->belongsTo(User::class, 'pengawas_id');
    }

    public function atlet()
    {
        return $this->belongsTo(User::class, 'atlet_id');
    }


}
