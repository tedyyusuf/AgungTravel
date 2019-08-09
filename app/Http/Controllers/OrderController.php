<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use DB;
use NahidulHasan\Html2pdf\Facades\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('order.index')->with('orders', $order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
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
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required',
          'phone_number' => 'required',
          'paket' => 'required',
          'day' => 'required',
          'month' => 'required',
          'year' => 'required',
          'person' => 'required',
          'payments' => 'required',
          'order_status' => 'required'
      ]);

      // Create Order
      $order = new Order;
      $order->title = $request->input('title');
      $order->first_name = $request->input('first_name');
      $order->last_name = $request->input('last_name');
      $order->email = $request->input('email');
      $order->phone_number = $request->input('phone_number');
      $order->paket = $request->input('paket');
      $order->day = $request->input('day');
      $order->month = $request->input('month');
      $order->year = $request->input('year');
      $order->person = $request->input('person');
      $order->payments = $request->input('payments');
      $order->order_status = $request->input('order_status');
      $order->user_id = auth()->user()->id;
      $order->save();

      return redirect('/order')->with('success', 'Pemesanan Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $order = Order::find($id);
      return view('order.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $order = Order::find($id);

      return view('order.edit')->with('order', $order);
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

      // Create Order
      $order = Order::find($id);
      $order->order_status = $request->input('order_status');
      $order->user_id = auth()->user()->id;
      $order->save();

      return redirect('/order')->with('success', 'Pembayaran Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $order = Order::find($id);


      //Check for correct user
      if(auth()->user()->id !==$order->user_id){
          return redirect('/order')->with('error', 'Unauthorized Page');
      }

      $order->delete();
      return redirect('/order')->with('success', 'Order Canceled');
    }
}
