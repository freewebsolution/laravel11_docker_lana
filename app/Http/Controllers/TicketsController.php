<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketFormRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index')->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketFormRequest $request)
    {
        try {
            // Creiamo il ticket usando Mass Assignment
            $ticket = Ticket::create([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => Str::uuid(),  // Utilizza un UUID univoco
            ]);

            // Reindirizza con un messaggio di successo
            return redirect()->route('tickets.create')->with('status', 'Your ticket has been created! Its unique id is: ' . $ticket->slug);
        } catch (\Exception $e) {
            // Gestisci l'errore se qualcosa va storto durante il salvataggio
            return redirect()->route('tickets.create')->with('error', 'An error occurred while creating your ticket.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
