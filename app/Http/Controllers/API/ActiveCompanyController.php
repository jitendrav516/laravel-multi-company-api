<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SetActiveCompanyRequest;

class ActiveCompanyController extends Controller
{
    public function setActive(SetActiveCompanyRequest $request)
    {
        $data = $request->validated();
        $company = $request->user()->companies()->where('id', $data['company_id'])->first();
        if (! $company) return response()->json(['message' => 'Company not found or not owner'], 404);

        $request->user()->update(['active_company_id' => $company->id]);
        return response()->json(['message' => 'Active company set', 'active_company' => $company], 200);
    }

    public function getActive(Request $request)
    {
        $company = $request->user()->activeCompany;
        if (! $company) return response()->json(['message' => 'No active company set'], 404);
        return response()->json($company, 200);
    }
}
