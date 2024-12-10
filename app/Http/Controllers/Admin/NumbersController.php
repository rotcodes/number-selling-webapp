<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NumbersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $numbers = Number::all();
        return view('auth.admin.numbers.list',[
            'numbers' => $numbers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.admin.numbers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:numbers,name|max:255',
            'price' => 'required',
            'is_available' => 'required',
            'desc' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Create and save the user
        $user = Number::create([
            'name' => $request->name,
            'price' => $request->price,
            'is_available' => $request->is_available,
            'description' => $request->desc,
        ]);

        session()->flash('success', 'Number has been created and added to database successfully!.');

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Number created successfully!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $number = Number::findOrFail($id);
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:numbers,name,'.$id,
            'price' => 'required',
            'is_available' => 'required',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Find the courseLabel
        $number = Number::findOrFail($id);
        $number->name = $request->name; // Get validated name input
        $number->price = $request->price; // Get validated name input
        $number->is_available = $request->is_available; // Get validated name input
        $number->description = $request->desc; // Get validated name input

        // Save the courseLabel to the database
        $number->save();

        session()->flash('success', 'Number updated successfully!');

        return response()->json([
            'status' => true,
            'message' => 'Number updated successfully!',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the category
        $number = Number::findOrFail($id);

        // Delete the category
        $number->delete();

        session()->flash('success', 'Number deleted successfully!');

        return response()->json([
            'status' => true,
            'message' => 'Number deleted successfully!',
        ]);
    }
}
