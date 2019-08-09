<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Tour;
use DB;

class TourController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::orderBy('created_at', 'desc')->paginate(10);
        return view('tour.index')->with('tours', $tours);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tour.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
          'title' => 'required',
          'body' => 'required',
          'cover_image' => 'image|nullable|max:1999'
      ]);

      // Handle File Upload
      if($request->hasFile('cover_image')){
          // Get filename with the extension
          $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
          // Get just filename
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          // Get just ext
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          // Filename to store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          // Upload Image
          $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
      } else {
          $fileNameToStore = 'noimage.jpg';
      }

      // Create Post
      $tour = new Tour;
      $tour->title = $request->input('title');
      $tour->body = $request->input('body');
      $tour->user_id = auth()->user()->id;
      $tour->cover_image = $fileNameToStore;
      $tour->save();

      return redirect('/tour')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $tour = Tour::find($id);
      return view('tour.show')->with('tour', $tour);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $tour = Tour::find($id);

      //Check for correct user
      if(auth()->user()->id !==$tour->user_id){
          return redirect('/tour')->with('error', 'Unauthorized Page');
      }

      return view('tour.edit')->with('tour', $tour);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
          'title' => 'required',
          'body' => 'required'
      ]);

      // Handle File Upload
      if($request->hasFile('cover_image')){
          // Get filename with the extension
          $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
          // Get just filename
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          // Get just ext
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          // Filename to store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          // Upload Image
          $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
      }

      // Create Post
      $tour = Tour::find($id);
      $tour->title = $request->input('title');
      $tour->body = $request->input('body');
      if($request->hasFile('cover_image')){
          $tour->cover_image = $fileNameToStore;
      }
      $tour->save();

      return redirect('/tour')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $tour = Tour::find($id);


      //Check for correct user
      if(auth()->user()->id !==$tour->user_id){
          return redirect('/tour')->with('error', 'Unauthorized Page');
      }

      if($tour->cover_image != 'noimage.jpg'){
          // Delete Image
          Storage::delete('public/cover_image/'.$tour->cover_image);
      }

      $tour->delete();
      return redirect('/tour')->with('success', 'Post Removed');
    }
}
