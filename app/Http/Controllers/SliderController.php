<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
   public function index()
    {
        $sliders = Slider::latest()->get();
        return view('sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'mobile_image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'desktop_image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'status' => 'required|boolean'
        ]);

        $mobilePath = $request->file('mobile_image')->store('sliders', 'public');
        $desktopPath = $request->file('desktop_image')->store('sliders', 'public');

        Slider::create([
            'title' => $request->title,
            'mobile_image' => $mobilePath,
            'desktop_image' => $desktopPath,
            'status' => $request->status,
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'mobile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'desktop_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'status' => 'required|boolean'
        ]);

        if ($request->hasFile('mobile_image')) {
            Storage::disk('public')->delete($slider->mobile_image);
            $slider->mobile_image = $request->file('mobile_image')->store('sliders', 'public');
        }

        if ($request->hasFile('desktop_image')) {
            Storage::disk('public')->delete($slider->desktop_image);
            $slider->desktop_image = $request->file('desktop_image')->store('sliders', 'public');
        }

        $slider->update([
            'title' => $request->title,
            'status' => $request->status,
            'mobile_image' => $slider->mobile_image,
            'desktop_image' => $slider->desktop_image,
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete([$slider->mobile_image, $slider->desktop_image]);
        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
