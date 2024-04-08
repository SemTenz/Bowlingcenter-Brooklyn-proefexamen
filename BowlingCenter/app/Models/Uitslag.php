<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Uitslag;

class UitslagenController extends Controller
{
    public function index()
    {
        // Haal de uitslagen op en sorteer aflopend op aantalpunten
        $uitslagen = Uitslag::orderByDesc('aantalpunten')->get();

        // Stuur de uitslagen naar de weergave
        return view('uitslagen.index', compact('uitslagen'));
    }
}
