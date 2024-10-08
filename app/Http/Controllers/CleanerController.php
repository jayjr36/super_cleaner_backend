<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cleaner;
use App\Models\CleanerDocument;
use Illuminate\Support\Facades\Log;

class CleanerController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:cleaners',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:85',
            'documents' => 'array',
            'documents.*' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $cleaner = Cleaner::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
        ]);

        foreach ($validatedData['documents'] as $document) {
            $path = $document->store('documents'); // Store the document
            CleanerDocument::create([
                'cleaner_id' => $cleaner->id,
                'document_path' => $path,
            ]);
        }

        return response()->json('Application submitted successfully');
    }

    // List pending applications for admin approval
    public function getPendingApplications()
    {
        $pendingCleaners = Cleaner::where('status', 'pending')->with('documents')->get();
        Log('Pending cleaner applications retrieved'+ $pendingCleaners);
        return response()->json($pendingCleaners);
    }

    // Approve or reject cleaner application
    public function updateApplicationStatus($id, Request $request)
    {
        $cleaner = Cleaner::findOrFail($id);
        $status = $request->input('status'); // 'approved' or 'rejected'

        if (in_array($status, ['approved', 'rejected'])) {
            $cleaner->update(['status' => $status]);
            return response()->json(['message' => "Application $status successfully"]);
        }

        return response()->json(['message' => 'Invalid status'], 400);
    }
}
