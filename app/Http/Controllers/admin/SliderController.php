<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;

class SliderController extends Controller
{
   public function index()
   {    
        $sliders = Slider::all();
        return view('admin/slider/index', compact('sliders'));
   }

   public function create()
   {       
        return view('admin/slider/create');
   }

   public function store(SliderRequest $request)
   {
         $slider = Slider::create([
            'name' => $request->name,
            'body' => $request->body,
        ]);

       
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time(). '_'. $file->getClientOriginalName();
            $dir = public_path('images');
            $file->move($dir,$filename);

            $slider->images()->create([
                'path' => $filename,
            ]);
        }
        return redirect('admin/slider')->with('message', 'A slider is created successfully');
   }
}
