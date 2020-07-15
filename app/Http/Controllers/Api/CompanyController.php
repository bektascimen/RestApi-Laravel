<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Company[]|Collection
     */
    public function index()
    {
        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $company = Company::create($input);

        return response([
            'data' => $company,
            'message' => 'Şirket eklendi.'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return Response
     */
    public function show(Company $company)
    {
        $companies = Company::find($company);
        if ($companies)
            return response($companies, 200);
        else
            return response(['message' => 'Şirket bulunamadı.'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return Response
     */
    public function update(Request $request, Company $company)
    {
        $input = $request->all();

        $company->update($input);

        return response([
            'data' => $company,
            'message' => 'Şirket bilgileri güncellendi.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return Response
     * @throws Exception
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return response([
            'message' => 'Şirket silindi.'
        ], 200);
    }
}
