<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
      $title = '#VacationLahDoloe';
      //return view('pages.index', compact('title'));
      return view('pages.index')->with('title', $title);
    }

    public function about(){
      $title = 'Tentang Kita';
      return view('pages.about')->with('title', $title);
    }

    public function services(){
      $data = array(
        'title' => 'Services',
        'services' => ['Travel Packages', 'Rent Car', 'Hotel Booking']
      );
      return view('pages.services')->with($data);
    }
}
