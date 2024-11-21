<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::all();
        return view('web.agenda.index', compact('agendas'));
    }

    public function showByDate($date)
    {
        $agendas = Agenda::whereDate('tanggal', $date)->get();
        return view('web.agenda.show-by-date', compact('agendas', 'date'));
    }
}
