<?php

namespace App\Http\Controllers;

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
        return response()->json(
            Book::all()
        );
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
        $input = $request->all();

        $validator = Validator::make(
            $input,
            [
                'title' => 'required',
                'description' => 'required',
                'author' => 'required',
                'publisher' => 'required',
                'date_of_issue' => 'required | date'
            ]
        );

        if ($validator -> fails()){
            return response()->json(
                $validator->errors(),
                400
            );
        }

        Book::create($input);

        return response()->json(
            [
                'Book created successfully'
            ],
            201
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(
            Book::findOrFail($id)
        );
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
        $input = $request->all();

        $validator = Validator::make(
            $input,
            [
                'title' => 'required',
                'description' => 'required',
                'author' => 'required',
                'publisher' => 'required',
                'date_of_issue' => 'required | date'
            ]
        );

        if ($validator -> fails()){
            return response()->json(
                [
                    $validator->errors()
                ],
                400
            );
        }

        $Book = Book::findOrFail($id);
        $Book->title = $input['title'];
        $Book->description = $input['description'];
        $Book->author = $input['author'];
        $Book->publisher = $input['publisher'];
        $Book->date_of_issue = $input['date_of_issue'];
        $Book->save();

        return response()->json(
            'Book edited successfully',
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::destroy($id);
        return response()->json(
            'Book deleted successfully',
            200
        );
    }
}