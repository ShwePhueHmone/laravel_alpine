<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::get();
        return response()->json($companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        if (!$request->image) {
            return response()->json(['message' => 'Missing file'], 422);
        }
        $imageName = time().'.'. $request->image->extension();
        $request->image->move(storage_path('app/public/img'), $imageName);
        $companies= Company::create([
            'name'=> $request->name,
            'image'=> $imageName
        ]);
        return response([
            "results" => "1",
            "message" =>"Created successfully",
            "data" => $companies
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        return response([
            "results" => "1",
            "message" =>"success",
            "data" => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        if ($request->file('image')) {
            if (File::exists(storage_path('app/public/img') . $company->image)) {
                File::delete(storage_path('app/public/img') . $company->image);
            }
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->image->move(storage_path('app/public/img'), $imageName);
            $company->image = $imageName;
        }
        $company->name = $request->name;
        $company->save();
        return response([
            "results" => "1",
            "message" =>"Updated successfully",
            "data" => $company
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return response()->json(['message' => 'Company has been deleted successfully'], 200);
    }
}