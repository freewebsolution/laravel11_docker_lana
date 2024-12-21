<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketFormRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

            $data = [
                'ticket' => $ticket->slug->toString(), // Converti l'UUID in stringa
                'user' => Auth::user()->email
            ];
            
            // Invia l'email
            Mail::raw("You have a new ticket. The unique ID (slug) is: {$data['ticket']}", function ($message) use ($data) {
                $message->to('info@tuaemail.it')
                        ->subject('New Ticket Created from: ' . $data['user']);
            });
            


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
        $comments = $ticket->comments()->get();
        return view('tickets.show', compact('ticket', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketFormRequest $request, string $slug)
    {
        $ticket = Ticket::where('slug', $slug)->firstOrFail();

        $ticket->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => $request->boolean('status') ? 0 : 1, // Utilizzo di boolean() per semplificare il check
        ]);

        return redirect()->route('tickets.edit', $ticket->slug)
            ->with('status', "The ticket '{$slug}' has been updated!");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        // Trova il ticket per slug
        $ticket = Ticket::where('slug', $slug)->firstOrFail();

        // Elimina il ticket
        $ticket->delete();

        // Redirect con messaggio di stato
        return redirect()->route('tickets.index')->with('status', "The ticket '{$ticket->title}' has been deleted!");
    }
}
