<?php

namespace App\Http\Controllers\API;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \Response::json([
            'status' => [
                'code' => 200,
                'message' => 'Berhasil'
            ],
            'data' => Book::all()
        ], 200);
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
        Book::create($request->all());

        return \Response::json([
            'status' => [
                'code' => 200,
                'message' => 'Data berhasil ditambahkan'
            ],
            'data' => $request->all()
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \Response::json([
            'status' => [
                'code' => 200,
                'message' => 'Berhasil'
            ],
            'data' => Book::where('code', $id)->first()
        ], 200);
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
        Book::where('code', $id)->update($request->all());

        return \Response::json([
            'status' => [
                'code' => 200,
                'message' => 'Data berhasil diubah'
            ],
            'data' => $request->all()
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::where('code', $id)->delete();

        return \Response::json([
            'status' => [
                'code' => 200,
                'message' => 'Data berhasil dihapus'
            ],
            'data' => $id
        ], 200);
    }
}
