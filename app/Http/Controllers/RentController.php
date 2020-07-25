<?php

namespace App\Http\Controllers;

use App\Book;
use App\Rent;
use Auth;
use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rents = Rent::with('user')->with('book')->with('status')->get();
        return datatables()->of($rents)->make(true);
    }

    public function history()
    {
        $rents = Rent::where('user_id', Auth::user()->id)->with('user')->with('book')->with('status')->get();
        return datatables()->of($rents)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Rent::create($request->all());

        return \Response::json(array(
            'type' => 'success',
            'title' => 'Pengajuan peminjaman buku berhasil',
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if (Rent::where('id', $id)->update($request->all())) {
            if ($request->input('status_id') == 2) {
                Book::find($request->input('book_id'))->decrement('stock', 1);
            } else if ($request->input('status_id') == 4) {
                Book::find($request->input('book_id'))->increment('stock', 1);
            }

        }

        return \Response::json(array(
            'type' => 'success',
            'title' => 'Perubahan status peminjaman berhasil',
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
