<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Travel;
use DB;

class TravelController extends Controller
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
      $travels = Travel::orderBy('created_at', 'desc')->paginate(10);
      return view('travel.index')->with('travels', $travels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('travel.create');
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
      $travel = new Travel;
      $travel->title = $request->input('title');
      $travel->body = $request->input('body');
      $travel->user_id = auth()->user()->id;
      $travel->cover_image = $fileNameToStore;
      $travel->save();

      return redirect('/travel')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $travel = Travel::find($id);
      return view('travel.show')->with('travel', $travel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $travel = Travel::find($id);

      //Check for correct user
      if(auth()->user()->id !==$travel->user_id){
          return redirect('/travel')->with('error', 'Unauthorized Page');
      }

      return view('travel.edit')->with('travel', $travel);
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
      $travel = Travel::find($id);
      $travel->title = $request->input('title');
      $travel->body = $request->input('body');
      if($request->hasFile('cover_image')){
          $travel->cover_image = $fileNameToStore;
      }
      $travel->save();

      return redirect('/travel')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $travel = Travel::find($id);


      //Check for correct user
      if(auth()->user()->id !==$travel->user_id){
          return redirect('/travel')->with('error', 'Unauthorized Page');
      }

      if($travel->cover_image != 'noimage.jpg'){
          // Delete Image
          Storage::delete('public/cover_image/'.$travel->cover_image);
      }

      $travel->delete();
      return redirect('/travel')->with('success', 'Post Removed');
    }
}
