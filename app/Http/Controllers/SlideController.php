<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

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
            'day'           => 'required|integer|in:1,2,3',
            'speaker'       => 'required|string|max:255',
            'title'         => 'required|string|max:500',
            'pdf_url'       => 'nullable|url|max:500',
        ]);

        Slide::create($request->only('day', 'speaker', 'title', 'pdf_url'));

        return back()->with('slide_success', 'Slide added successfully!');
    }

    public function destroy(Slide $slide)
    {
        $slide->delete();
        return back()->with('slide_success', 'Slide deleted.');
    }

    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'day'           => 'required|integer|in:1,2,3',
            'speaker'       => 'required|string|max:255',
            'title'         => 'required|string|max:500',
            'pdf_url'       => 'nullable|url|max:500',
        ]);

        $slide->update($request->only('day', 'speaker', 'title', 'pdf_url'));

        return back()->with('slide_success', 'Slide updated!');
    }
}