<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::orderBy('time', 'DESC')->get();

        $response = [
            'message' => 'list data',
            'data' => $transaction
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
            'judul' => ['required'],
            'total' => ['required', 'numeric'],
            'tipe' => ['required', 'in:pemasukan, pengeluaran']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $transaction = Transaction::create($request->all());
            $response = [
                'message' => 'Data di tambah',
                'data' => $transaction
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "gagal simpan" . report($th)
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
        $transaction = Transaction::FindOrFail($id);
        $response = [
            'message' => 'Detail',
            'data' => $transaction
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
        $transaction = Transaction::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'judul' => ['required'],
            'total' => ['required', 'numeric'],
            'tipe' => ['required', 'in:pemasukan, pengeluaran']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $transaction->update($request->all());
            $response = [
                'message' => 'Berhasil di ubah',
                'data' => $transaction
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "gagal simpan" . report($th)
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
        $transaction = Transaction::FindOrfail($id);

        try {
            $transaction->delete();
            $response = [
                'message' => 'data di hapus'
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "gagal delete" . report($th)
            ]);
        }
    }
}
