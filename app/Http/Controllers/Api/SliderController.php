<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\SliderResource;

class SliderController extends BaseController
{
    /**
     * Display a listing of sliders.
     */
    public function index()
    {
        return SliderResource::collection(Slider::all());
    }

    /**
     * Store a newly created slider.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|url'
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        $slider = Slider::create([
            'image' => $path,
            'link' => $request->link,
        ]);

        return new SliderResource($slider);
    }

    /**
     * Display the specified slider.
     */
    public function show(Slider $slider)
    {
        return new SliderResource($slider);
    }

    /**
     * Update the specified slider.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|url'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($slider->image);

            // Store new image
            $path = $request->file('image')->store('sliders', 'public');
            $slider->image = $path;
        }

        $slider->link = $request->link;
        $slider->save();

        return new SliderResource($slider);
    }

    /**
     * Remove the specified slider.
     */
    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image);
        $slider->delete();

        return response()->json(['message' => 'Slider deleted successfully.'], 200);
    }
}
