<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = $request->user()->companies()->get();
        return response()->json($companies, 200);
    }

    public function store(StoreCompanyRequest $request)
    {
        $data = $request->validated();
        $company = $request->user()->companies()->create($data);
        return response()->json($company, 201);
    }

    public function show(Request $request, $id)
    {
        $company = $request->user()->companies()->where('id', $id)->first();
        if (! $company) return response()->json(['message' => 'Not found'], 404);
        return response()->json($company);
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = $request->user()->companies()->where('id', $id)->first();
        if (! $company) return response()->json(['message' => 'Not found'], 404);
        $company->update($request->validated());
        return response()->json($company);
    }

    public function destroy(Request $request, $id)
    {
        $company = $request->user()->companies()->where('id', $id)->first();
        if (! $company) return response()->json(['message' => 'Not found'], 404);

        if ($request->user()->active_company_id == $company->id) {
            $request->user()->update(['active_company_id' => null]);
        }

        $company->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
