<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('partials._client.clients');
    }

    public function create()
    {
        $clients = Client::all();
        return view('partials._client.clients_list', compact('clients'));
    }

    public function edit($id)
    {
        // Fetch the client by ID
        $client = Client::findOrFail($id);

        // Return the edit view with the client data
        return view('partials._client.clients_edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'salutation' => 'required|string|max:10',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'mobile_phone' => 'nullable|string|max:15',
            'client_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tour_consultant' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
        ]);

        $client = Client::findOrFail($id);
        $client->update($validatedData);

        // Handle file upload for client_image
        if ($request->hasFile('client_image')) {
            $file = $request->file('client_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/clients', $fileName, 'public');
            $client->client_image = $filePath;
            $client->save();
        }

        return redirect()->back()->with('success', 'Client updated successfully!');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'salutation' => 'required|string|max:10',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'mobile_phone' => 'nullable|string|max:15',
            'client_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate uploaded file
            'tour_consultant' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
        ]);

        $data = $validatedData;

        // Handle file upload for client_image
        if ($request->hasFile('client_image')) {
            $file = $request->file('client_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/clients', $fileName, 'public');
            $data['client_image'] = $filePath;
        }

        // Save client data
        Client::create($data);

        return redirect()->route('clients.create')->with('success', 'Client added successfully!');
    }

    public function show($id)
    {
        // Fetch the client by ID
        $client = Client::findOrFail($id);

        // Return the client overview view with the client data
        return view('partials._client.clients_overview', compact('client'));
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();  // Soft delete the client

        return redirect()->route('clients.index')->with('success', 'Client moved to deleted folder.');
    }

    public function trashed()
    {
        $clients = Client::onlyTrashed()->get();  // Retrieve soft-deleted clients
        return view('trashed.clients_trashed', compact('clients'));
    }

    public function restore($id)
    {
        $client = Client::withTrashed()->findOrFail($id);
        $client->restore();  // Restore the deleted client

        return redirect()->route('clients.trashed')->with('success', 'Client restored successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $clients = Client::where('display_name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('mobile_phone', 'like', '%' . $query . '%')
            ->get()
            ->map(function ($client) {
                if ($client->client_image) {
                    $client->client_image = asset('storage/' . $client->client_image);
                }
                return $client;
            });

        return response()->json($clients);
    }

    public function temp()
    {
        $clients = Client::all();
        return view('partials._quotation.quotation', compact('clients'));
    }

}
