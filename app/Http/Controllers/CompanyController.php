<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(): object
    {
        $companies = Company::paginate(3);
        return CompanyResource::collection($companies);
    }

    public function show(Company $company): object
    {
        return (new CompanyResource($company));
    }
    public function store(CompanyStoreRequest $request): object
    {
        $data = $request->validated();
        $company = Company::create($data);
        return (new CompanyResource($company));
    }
    public function update(CompanyUpdateRequest $request, Company $company): object
    {
        $data = $request->validated();
        $company->update($data);
        return (new CompanyResource($company));
    }

    public function delete(Company $company): mixed
    {
        User::where(['company_id' => $company->id])->update(['company_id' => null]);
        $company->delete();
        return response('', 204);
    }
}
