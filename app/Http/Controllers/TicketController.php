<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function crearTicket(Request $request)
    {
        return redirect()->route('tickets.index')->with('mensaje', 'Ticket creado con éxito');
    }
}
