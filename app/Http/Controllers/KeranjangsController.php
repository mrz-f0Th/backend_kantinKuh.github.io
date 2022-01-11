<?php

namespace App\Http\Controllers;

use App\Models\Keranjangs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class KeranjangsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjangs = Keranjangs::orderBy('created_at', 'DESC')->with('produk')->get();
        $response = [
            'message' => 'Data Keranjang Ordered by created_at',
            'data' => $keranjangs
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_pemesanan' => ['required'],
            'keterangan' => [''],
            'produk_id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $keranjangs = Keranjangs::create($request->all());
            $response = [
                'message' => 'Success Creating Keranjang',
                'data' => $keranjangs
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keranjangs = Keranjangs::findOrFail($id);

        try {
            $keranjangs->delete();
            $response = [
                'message' => 'Success Deleting Produk'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
