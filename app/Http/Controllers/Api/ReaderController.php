<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = 1;
        $data = Reader::all();
        if ($data->isEmpty()) {
            $status = -1;
            $message = "No Data";
        }
        else {
            $message = "Successful!";
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ]);
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
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
            'name' => 'required',
            'address' => 'required',
        ], [
            //Required
                'name.required' => 'Please enter reader\'s name!',
                'address.required' => 'Please enter reader\'s address!',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => -2,
                'errors' => $validator->errors()->toArray(),
            ]);
        }
        $reader = Reader::create($request->all());
        
        return response()->json([
            'status' => 1,
            'data' => $reader,
            'message' => "Create Reader Successful!",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reader  $reader
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = 1;
        $reader = Reader::find($id);
        if ($reader == null) {
            $status = -1;
            $message = "Cannot find this Reader!";
        }
        else {
            $message = "Successful!";
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $reader,
            ]);
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reader  $reader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = 1;
        $reader = Reader::find($id);
        if ($reader == null) {
            $status = -1;
            $message = "Cannot find this Reader!";
        }
        else {
            $reader->update($request->all());
            $message = "Update Successful!";
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reader  $reader
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = 1;
        $reader = Reader::find($id);
        if ($reader == null) {
            $status = -1;
            $message = "Cannot find this Reader!";
        }
        else {
            $reader->delete();
            $message = "Delete Successful!";
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }
}
