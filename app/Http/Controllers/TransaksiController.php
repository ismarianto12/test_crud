<?php

namespace App\Http\Controllers;

use App\Konsumen;
use App\Transaksi;
use Illuminate\Http\Request;
use Validator;
use DataTables;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  [];
        return view('transaksi', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function api()
    {
        $fdata = Transaksi::get();
        return Datatables::of($fdata)
            ->addColumn('action', function ($data) {
                $button = '<button type="button" name="edit" to="' . route('konsumen.edit', $data->id) . '" class="edit btn btn-primary btn-sm">Edit</button>';
                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                return $button;
            })
            ->addColumn('anggota_rapat', $fdata->count())
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {

        $data = [
            'konsumen' => '',
            'jkendaraan' => '',
            'n_polisi' => '',
            'tgl_lahir' => '',
            'jk' => '',
            'no_hp' => ''
        ];
        return view('transaksi_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error =   Validator::make($request->all(), [
            'konsumen' => 'required',
            'jkendaraan' => 'required',
            'n_polisi' => 'required',
            'tgl_lahir' => 'required',
            'jk' => 'required',
            'no_hp' => 'required'
        ]);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        Konsumen::created($request->all());
        return response()->json(['errors' => $error->errors()->all()]);
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
        $r = Konsumen::findOrFail($id);
        $data = [
            'konsumen' => $r->konsumen,
            'jkendaraan' => $r->jkendaraan,
            'n_polisi' => $r->n_polisi,
            'tgl_lahir' => $r->tgl_lahir,
            'jk' => $r->jk,
            'no_hp' => $r->no_hp
        ];
        return view('transaksi_form', $data);
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

        $error =   Validator::make($request->all(), [
            'konsumen' => 'required',
            'jkendaraan' => 'required',
            'n_polisi' => 'required',
            'tgl_lahir' => 'required',
            'jk' => 'required',
            'no_hp' => 'required'
        ]);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        Konsumen::created($request->all());
        return response()->json(['errors' => $error->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $data = Konsumen::FindOrFail($request->id);
        $data->delete();
        return response()->json(['success' => 'data berhasil di hapus']);
    }
}
