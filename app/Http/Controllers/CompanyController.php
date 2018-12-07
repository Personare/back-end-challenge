<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
  
        $Companies = Company::all();
  
        return response()->json($Companies);
  
    }
  
    public function getCompany($idCompany)
    {
  
        $Company  = Company::find($idCompany);
  
        return response()->json($Company);
    }
  
    public function createCompany(Request $request)
    {
  
        $Company = Company::create($request->all());
  
        return response()->json($Company);
  
    }
  
    public function deleteCompany($idCompany)
    {
        $Company  = Company::find($idCompany);
        $Company->delete();
 
        return response()->json('deleted');
    }
  
    public function updateCompany(Request $request, $idCompany)
    {
        $Company  = Company::find($idCompany);
        $Company->name = $request->input('name');
        $Company->save();
  
        return response()->json($Company);
    }
}
