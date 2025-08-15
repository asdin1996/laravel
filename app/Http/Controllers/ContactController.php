<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('title')) {
            $query->where('name', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('contact_id')) {
            $query->where('id', $request->contact_id);
        }

        if ($request->has('clean')) {
            return redirect()->route('contacts.index'); // limpia todo
        }

        $contacts = $query->paginate(10)->appends($request->query());

        return view('contacts.index', compact('contacts'));
    }

        public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'file' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('files', 'public');
            $validated['file'] = $path;
        }

        Contact::create($validated);

        return redirect()->route('contacts.index')->with('success', 'Registrado correctamente');
    }

        public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', 'Usuario eliminado');
    }


}
