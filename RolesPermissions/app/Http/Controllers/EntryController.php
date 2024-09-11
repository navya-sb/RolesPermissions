<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $entries = Entry::with('user')->paginate(10);
        } else {
            $entries = Auth::user()->entries()->paginate(10);
        }

        return view('entries.index', compact('entries'));
    }

    public function create()
    {
        return view('entries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric',
        ]);

        Auth::user()->entries()->create($request->all());

        return redirect()->route('entries.index');
    }

    public function edit(Entry $entry)
    {
        if (Auth::user()->cannot('update', $entry)) {
            return redirect()->route('entries.index');
        }

        return view('entries.edit', compact('entry'));
    }

    public function update(Request $request, Entry $entry)
    {
        $request->validate([
            'item' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric',
        ]);

        $entry->update($request->all());

        return redirect()->route('entries.index');
    }

    public function destroy(Entry $entry)
    {
        if (Auth::user()->cannot('delete', $entry)) {
            return redirect()->route('entries.index');
        }

        $entry->delete();

        return redirect()->route('entries.index');
    }
}
