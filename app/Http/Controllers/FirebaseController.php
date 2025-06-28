<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;

class FirebaseController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function showData()
    {
        $database = $this->firebase->getDatabase();

        $ototKanan = $database->getReference('Data/Otot_Kanan')->getValue();
        $ototKiri  = $database->getReference('Data/Otot_Kiri')->getValue();
        $repitisi  = $database->getReference('Data/Repitisi')->getValue();
        $reset     = $database->getReference('Data/reset')->getValue();

        return response()->json([
            'Otot_Kanan' => $ototKanan ?? 'Kosong',
            'Otot_Kiri'  => $ototKiri ?? 'Kosong',
            'Repitisi'   => $repitisi ?? 'Kosong',
            'reset'      => $reset ?? 'Kosong',
        ]);
    }
}
