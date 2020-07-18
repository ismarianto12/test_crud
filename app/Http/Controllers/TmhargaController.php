<?php

namespace App\Http\Controllers;

use App\Harga;
use Illuminate\Http\Request;
use App\Login;

use Validator;
use DataTables;

class TmhargaController  extends Controller
{
    public $view = 'tmharga';

    public function index()
    {
        $data =  [];
        return view($this->view . '.tmharga', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function api()
    {
        $fdata = Harga::with(['login:name,email'])->get();
        return Datatables::of($fdata)
            ->addColumn('action', function ($data) {
                $button = '<button type="button" name="edit" to="' . route('konsumen.edit', $data->id) . '" class="edit btn btn-primary btn-sm">Edit</button>';
                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                return $button;
            })
            ->editColumn('action_select', function ($data) {
                $s = '<button type="button" name="select" data="' . $data->id . '" class="select btn btn-primary btn-sm">Pilih.</button>';
                return $s;
            })
            ->addIndexColumn()
            ->rawColumns(['action','action_select'])
            ->toJson();
    }

    public function create()
    {

        $data = [
            'action' => route('konsumen.store'),
            'method' => method_field('post'),
            'params' => 'tambah',
            'harganm' => '',
            'waktu' => '',
            'user_id' => '',

        ];
        return view($this->view . '.tmharga_form', $data);
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
            'konsumen_id' => 'required',
            'nomor_polisi' => 'required',
            'masuk' => 'required',
            'keluar' => 'required',
            'biaya' => 'required',
        ]);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        Transaksi::created($request->all());
        return response()->json(['errors' => $error->errors()->all()]);
    }
    public function show($id)
    {
        $r = Transaksi::finOrFaild($id);
        $data = [
            'konsumen_id' => $r->konsumen_id,
            'nomor_polisi' => $r->nomor_polisi,
            'masuk' => $r->masuk,
            'keluar' => $r->keluar,
            'biaya' => $r->biaya,
        ];
        return view($this->view . '.tmharga_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $r = Transaksi::findOrFail($id);
        $data = [
            'action' => route('tmharga.update', $id),
            'params' => 'edit',
            'harganm' => $r->harganm,
            'waktu' => $r->waktu,
            'user_id' => Auth::user()->id,
        ];
        return view($this->view . '.tmharga_form', $data);
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
            'harganm' => 'required',
            'waktu' => 'required',
        ]);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        Harga::find($id)->update($request->all());
        return response()->json(['errors' => 'Data transaksi berhasil di update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $data = Harga::FindOrFail($request->id);
        $data->delete();
        return response()->json(['success' => 'data berhasil di hapus']);
    }
}
