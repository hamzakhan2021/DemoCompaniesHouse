<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function viewUnit()
    {  
        return view('unit');
    }

    public function searchCompany(Request $request)
    {
    	$key = $request->get('searchKey');
        $unit = Company::where('root_domain','LIKE',"%{$key}%")
                        ->orWhere('domain_authority','LIKE',"%{$key}%")
                        ->get();

        foreach($unit as $key => $value)
        {
            $imgLink = "https://logo.clearbit.com/".$value->root_domain."?size=200&greyscale=true";
            $unit[$key]['img'] =$imgLink;
        }

    	return response()->json([ 'unit' => $unit ],Response::HTTP_OK);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = Company::find($id);
      
        $imgLink = "https://logo.clearbit.com/".$unit->root_domain."?size=200&greyscale=true";
        $unit['img'] =$imgLink;
       
        return response()->json([ 'unit' => $unit ],Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
