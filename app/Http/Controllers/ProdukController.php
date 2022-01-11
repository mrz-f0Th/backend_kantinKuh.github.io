<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::orderBy('created_at', 'DESC')->get();
        foreach ($produk as $pr) {
            $kode = $pr->kode;
            $pr->gambar = env('APP_URL') . 'images/' . $pr->gambar;
        }

        $response = [
            'message' => 'Data Produk Ordered by created_at',
            'data' => $produk,
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
        var_dump($request->all());
        $validator = Validator::make($request->all(), [
            'kode' => ['required'],
            'nama' => ['required'],
            'harga' => ['required', 'numeric'],
            'status' => ['required', 'in:ada,habis'],
            'gambar' => ['required'],
            'kategori' => ['required', 'in:food,drink,snack']
        ]);




        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $nameImage = $request->id . "." . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $nameImage);
            $request->gambar = $nameImage;
            $produk = Produk::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'harga' => $request->harga,
                'status' => $request->status,
                'gambar' => $nameImage,
                'kategori' => $request->kategori
            ]);
            $response = [
                'message' => 'Success Creating Produk',
                'data' => $produk,
            ];


            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo . $request,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        $response = [
            'message' => 'Show Produk by id',
            'data' => $produk
        ];

        return response()->json($response, Response::HTTP_OK);
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
        $produk = Produk::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kode' => ['required'],
            'nama' => ['required'],
            'harga' => ['required', 'numeric'],
            'status' => ['required', 'in:ada,habis'],
            'gambar' => ['required'],
            'kategori' => ['required', 'in:food,drink,snack']
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $nameImage = $request->id . "." . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $nameImage);
            $request->gambar = $nameImage;
            $produk->update([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'harga' => $request->harga,
                'status' => $request->status,
                'gambar' => $nameImage,
                'kategori' => $request->kategori
            ]);
            $response = [
                'message' => 'Success Updating Produk',
                'data' => $produk,
            ];

            return response()->json($response, Response::HTTP_OK);
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
        $produk = Produk::findOrFail($id);

        try {
            $produk->delete();
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
