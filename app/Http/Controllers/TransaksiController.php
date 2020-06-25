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
        $fdata = Transaksi::with(['konsumen:konsumen'])->get();
        return Datatables::of($fdata)
            ->addColumn('action', function ($data) {
                $button = '<button type="button" name="edit" to="' . route('konsumen.edit', $data->id) . '" class="edit btn btn-primary btn-sm">Edit</button>';
                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {

        $data = [
            'action' => route('konsumen.store'),
            'method' => method_field('post'),
            'params' => 'tambah',
            'konsumen_id' => '',
            'nomor_polisi' => '',
            'masuk' => '',
            'keluar' => '',
            'biaya' => '',

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
    return view('transaksi_detail', $data);
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
            'action' => route('konsumen.update',$id),
            'params' => 'edit',
            'method' => method_field('put'),
            'konsumen_id' => $r->konsumen_id,
            'nomor_polisi' => $r->nomor_polisi,
            'masuk' => $r->masuk,
            'keluar' => $r->keluar,
            'biaya' => $r->biaya,
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
            'konsumen_id' => 'required',
            'nomor_polisi' => 'required',
            'masuk' => 'required',
            'keluar' => 'required',
            'biaya' => 'required',
        ]);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        Transaksi::find($id)->update($request->all());
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
        $data = Transaksi::FindOrFail($request->id);
        $data->delete();
        return response()->json(['success' => 'data berhasil di hapus']);
    }
}
