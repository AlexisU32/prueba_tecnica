<?php

namespace App\Http\Controllers;

use App\Models\Reddit;
use Dotenv\Validator;
use Illuminate\Http\Request;

class RedditController extends Controller
{
    /**
     * Display a listing of the resource.
     * Listado de todos los items
     */
    public function index()
    {
        try {
            $reddits = Reddit::all();
            return response()->json(['status' => true, 'reddits' => $reddits ], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error internal server'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $reddits = Reddit::find( $id );
            return response()->json(['status' => true, 'reddits' => $reddits ], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error internal server. ' + $id ], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
