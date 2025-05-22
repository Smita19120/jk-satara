<?php

// app/Http/Controllers/GalleryController.php
namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imageName = time().'.'.$request->image->extension();  
    $request->image->move(public_path('uploads/gallery'), $imageName);

    Gallery::create([
        'title' => $request->title,
        'description' => $request->description,
        'image_path' => $imageName,
    ]);

    return redirect()->route('admin.gallery.index')->with('success', 'Gallery item created successfully.');
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $gallery = Gallery::findOrFail($id);
    $data = [
        'title' => $request->title,
        'description' => $request->description,
    ];

    if ($request->hasFile('image')) {
        // Delete old image
        $oldImagePath = public_path('uploads/gallery/'.$gallery->image_path);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
        
        // Store new image
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('uploads/gallery'), $imageName);
        $data['image_path'] = $imageName;
    }

    $gallery->update($data);

    return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully!');
}

public function destroy($id)
{
    $gallery = Gallery::findOrFail($id);
    
    // Delete image file
    $imagePath = public_path('uploads/gallery/'.$gallery->image_path);
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
    
    $gallery->delete();

    return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully!');
}


    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    
}