<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Datatables;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function admin()
    {
        $users = User::where('role_id', '1')->with('role');
        return datatables()->of($users)->make(true);
    }

    public function member()
    {
        $users = User::where('role_id', '2');
        return datatables()->of($users)->make(true);
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
        $temp = [];
        foreach ($request->all() as $key => $value) {
            if ($key == 'password') {
                $temp[$key] = bcrypt($request->all()['password']);
            } else {
                $temp[$key] = $value;
            }
        }

        User::create($temp);

        return \Response::json(array(
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
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
        $temp = [];
        foreach ($request->all() as $key => $value) {
            if ($key == 'password') {
                if ($request->all()['password']) {
                    $temp[$key] = bcrypt($request->all()['password']);
                }

            } else {
                $temp[$key] = $value;
            }
        }

        User::where('id', $id)->update($temp);

        return \Response::json(array(
            'type' => 'success',
            'title' => 'Data berhasil diubah',
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
        User::destroy($id);

        return \Response::json(array(
            'type' => 'success',
            'title' => 'Data berhasil dihapus',
        ));
    }

    public function password(Request $request)
    {
        if (!Auth::attempt(['id' => Auth::user()->id, 'password' => $request->all()['oldPassword']])) {
            return \Response::json(array(
                'type' => 'error',
                'title' => 'Password lama yang anda masukkan salah',
            ));
        }

        User::where('id', Auth::user()->id)->update(['password' => bcrypt($request->all()['password'])]);

        return \Response::json(array(
            'type' => 'success',
            'title' => 'Password berhasil diubah',
        ));
    }
}
