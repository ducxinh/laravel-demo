<?php

namespace App\Http\Controllers\API\Brand;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\Brand\CreateBranchRequest;
use App\Http\Requests\Brand\ListBranchRequest;
use App\Http\Requests\Brand\UpdateBranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(ListBranchRequest $request)
    {
        $branches = Branch::paginate();
        return $this->responsePaginate($branches);
    }

    public function store(CreateBranchRequest $request)
    {
        $branch = Branch::create($request->validated());
        return response()->json($branch, 201);
    }

    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return response()->json($branch);
    }

    public function update(UpdateBranchRequest $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->update($request->validated());
        return response()->json($branch);
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return response()->json(null, 204);
    }
}
