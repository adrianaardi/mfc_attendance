<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('day')->orderBy('order')->orderBy('id')->get()->groupBy('day');
        return view('admin.slides', compact('slides'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'day'      => 'required|integer|in:1,2,3',
            'speaker'  => 'required|string|max:255',
            'title'    => 'required|string|max:500',
            'pdf_file' => 'nullable|file|mimes:pdf|max:20480', // Validates real PDFs up to 20MB
        ]);

        $data = $request->only('day', 'speaker', 'title');

        // Handle File Upload
        if ($request->hasFile('pdf_file')) {
            // Stores inside storage/app/public/slides
            $data['pdf_path'] = $request->file('pdf_file')->store('slides', 'public');
        }

        Slide::create($data);

        return back()->with('slide_success', 'Slide added successfully!');
    }

    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'day'      => 'required|integer|in:1,2,3',
            'speaker'  => 'required|string|max:255',
            'title'    => 'required|string|max:500',
            'pdf_file' => 'nullable|file|mimes:pdf|max:20480', 
        ]);

        $data = $request->only('day', 'speaker', 'title');

        // Handle File Replacement
        if ($request->hasFile('pdf_file')) {
            // Delete old file if it exists
            if ($slide->pdf_path && Storage::disk('public')->exists($slide->pdf_path)) {
                Storage::disk('public')->delete($slide->pdf_path);
            }
            // Store new file
            $data['pdf_path'] = $request->file('pdf_file')->store('slides', 'public');
        }

        $slide->update($data);

        return back()->with('slide_success', 'Slide updated!');
    }

    public function destroy(Slide $slide)
    {
        // Cleanup file from storage before deleting database entry
        if ($slide->pdf_path && Storage::disk('public')->exists($slide->pdf_path)) {
            Storage::disk('public')->delete($slide->pdf_path);
        }

        $slide->delete();
        return back()->with('slide_success', 'Slide deleted.');
    }
}