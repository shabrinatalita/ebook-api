<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            Author::all()
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
                'name' => 'required',
                'date_of_birth' => 'required | date',
                'place_of_birth' => 'required',
                'gender' => 'required',
                'email' => 'required',
                'hp' => 'required',
            ]
        );

        if ($validator -> fails()){
            return response()->json(
                $validator->errors(),
                400
            );
        }

        Author::create($input);

        return response()->json(
            [
                'Author created successfully'
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
            Author::findOrFail($id)
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
                'name' => 'required',
                'date_of_birth' => 'required | date',
                'place_of_birth' => 'required',
                'gender' => 'required',
                'email' => 'required',
                'hp' => 'required',
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

        $Author = Author::findOrFail($id);
        $Author->name = $input['name'];
        $Author->date_of_birth = $input['date_of_birth'];
        $Author->place_of_birth = $input['place_of_birth'];
        $Author->gender = $input['gender'];
        $Author->email = $input['email'];
        $Author->hp = $input ['hp'];
        $Author->save();

        return response()->json(
            'Author edited successfully',
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
        Author::destroy($id);
        return response()->json(
            'Author deleted successfully',
            200
        );
    }
}