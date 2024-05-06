<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChildModel;
use Illuminate\Http\Request;
use App\Models\ParentModel;

class formSubmit extends Controller
{
    public function create(Request $request)
    {
        try {
           
            $validatedRequest = $request->validate([
                'father_name' => 'required|string|min:3',
                'mother_name' => 'required|string|min:3',
                'child_name' => 'required|string|min:3'
            ]);
            
            // check if parent exists
            $parents = ParentModel::firstOrCreate([
                'father_name' => $validatedRequest['father_name'],
                'mother_name' => $validatedRequest['mother_name']
            ]);
            
            $existingChild = $parents->children()->where('child_name', $validatedRequest['child_name'])->first();
            if ($existingChild) {
                // child_name already exists
                return response()->json(['error' => 'Child already registered'], 401);
            }
            // create new chid
            $child = $parents->children()->create([
                'child_name' => $validatedRequest['child_name']
            ]);
            return response()->json(['success' => 'child registered successfully']);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function getSibling($childId)
    {
        $child = ChildModel::find($childId);
        if ($child) {
            $parent = $child->parents;
            $siblings = $parent->children()->where('id', '!=', $childId)->get();
            return response()->json([$siblings]);
        } else {
            return response()->json(['error' => 'invalid child provided'], 400);
        }
    }

    public function getChildById($childId)
    {
        $child = ChildModel::find($childId);
        if ($child) {
            return response()->json([$child], 200);
        } else {
            return response()->json(['error' => 'invalid child provided'], 400);
        }
    }

    public function getParents($childId)
    {
        $child = ChildModel::find($childId);
        if ($child) {
            $parent = $child->parents;
            return response()->json([$parent], 200);
        } else {
            return response()->json(['error' => 'invalid child provided'], 400);
        }
    }

    public function getAllChilds($parentId)
    {
        $parents = ParentModel::find($parentId);
       
        if ($parents) {
            $childrens = $parents->children;
            return response()->json([$childrens], 200);
        } else {
            return response()->json(['error' => 'invalid parent provided'], 400);
        }
    }
}
