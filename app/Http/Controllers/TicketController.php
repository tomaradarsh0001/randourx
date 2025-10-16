<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['resolve']);
    }

    public function index()
    {
        if (Auth::user()->is_admin === 1) {
            $tickets = Ticket::with('user')->latest()->get();
            return view('tickets.indexAdmin', compact('tickets'));
        } else {
            $tickets = Auth::user()->tickets()->latest()->get();
            return view('tickets.index', compact('tickets'));
        }

    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket created successfully!');
    }

    public function show(Ticket $ticket)
    {
        // Authorization - users can only see their own tickets, admins can see all
        if (Auth::user()->is_admin !== 1 && $ticket->user_id !== Auth::id()) {
            abort(403, 'You can only view your own tickets.');
        }

        return view('tickets.show', compact('ticket'));
    }

    public function resolve(Ticket $ticket, Request $request)
    {
        // Middleware already ensures user is admin, but double check
        if (Auth::user()->is_admin !== 1) {
            abort(403, 'Admin access required.');
        }

        $request->validate([
            'admin_response' => 'required|string',
        ]);

        $ticket->update([
            'status' => 'resolved',
            'admin_response' => $request->admin_response,
            'admin_id' => Auth::id(),
            'resolved_at' => now(),
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket resolved successfully!');
    }
}