<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = 1;
        $data = Book::all();
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
            'title' => 'required',
            'year' => 'required|numeric',
            'image' => 'image|max:2048',
            'language' => 'required',
            'pagesNum' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
        ], [
            //Required
                'title.required' => 'Please enter the title!',
                'year.required' => 'Please enter the publish year!',
                'language.required' => 'Please enter the language of the book!',
                'pagesNum.required' => 'Please enter the pages number!',
                'category_id.required' => 'Please enter the Category!',
                'publisher_id.required' => 'Please enter the Publisher!',
                'author_id.required' => 'Please enter the Author!',
            //Numeric
                'year.numeric' => 'Please enter a number!',
                'pagesNum.numeric' => 'Please enter a number!',
            //Exists
                'category_id.exists' => 'Please enter a correct Category!',
                'publisher_id.exists' => 'Please enter a correct Publisher!',
                'author_id.exists' => 'Please enter a correct Author!',
            //Image
                'image.image' => 'Please select an image!',
            //Size
                'image.max' => 'Capacity exceeded :max KB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => -2,
                'errors' => $validator->errors()->toArray(),
            ]);
        }
        //Add Image
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = $this->saveImage($request->file('image'));
        }
        $book = Book::create([
            'title' => $request->input('title'),
            'year' => $request->input('year'),
            'image' => $imageName,
            'language' => $request->input('language'),
            'pagesNum' => $request->input('pagesNum'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'publisher_id' => $request->input('publisher_id'),
            'author_id' => $request->input('author_id'),
        ]);
        
        return response()->json([
            'status' => 1,
            'data' => $book,
            'message' => "Create Book Successful!",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = 1;
        $book = Book::find($id);
        if ($book == null) {
            $status = -1;
            $message = "Cannot find this Book!";
        }
        else {
            $message = "Successful!";
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $book,
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
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = 1;
        $book = Book::find($id);
        if ($book == null) {
            $status = -1;
            $message = "Cannot find this Book!";
        }
        else {
            $book->update($request->all());
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
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = 1;
        $book = Book::find($id);
        if ($book == null) {
            $status = -1;
            $message = "Cannot find this Book!";
        }
        else {
            $this->deleteImage($book->image);
            $book->delete();
            $message = "Delete Successful!";
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }

    public function saveImage ($image) {
        if (!empty($image) && public_path('uploads')) {
            $folderName = date('Y-m');
            $fileNameWithTimestamp = md5($image->getClientOriginalName() . time());
            $fileName = $fileNameWithTimestamp . '.' . $image->getClientOriginalExtension();
            if (!file_exists(public_path('uploads/' . $folderName))) {
                mkdir(public_path('uploads/' . $folderName), 0755);
            }
            //Di chuyển file vào folder Uploads
            $imageName = "$folderName/$fileName";
            $image->move(public_path('uploads/' . $folderName), $fileName);

            return $imageName;
        }
    }

    public function deleteImage($path) {
        if (!is_dir(public_path('uploads/' . $path)) && file_exists(public_path('uploads/' . $path))) {
            unlink(public_path('uploads/' . $path));
        }
    }
}
