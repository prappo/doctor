<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function addIndex()
    {
        return view('category.add');
    }

    public function add(Request $request)
    {
        if (Category::where('value', $request->value)->exists()) {
            return "This category already exist";
        }

        try {
            $cat = new Category();
            $cat->value = $request->value;
            $cat->save();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function assign(Request $request)
    {
        if (User::where('id', $request->id)->where('cat', $request->cat)->exists()) {
            return "Already assigned";
        }

        try {
            User::where('id', $request->userId)->update([
                'cat' => $request->cat
            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function delete(Request $request)
    {
        try {
            Category::where('id', $request->id)->delete();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function edit(Request $request)
    {
        if($request->value == ""){
            return "Can't be empty";
        }
        try {
            Category::where('id', $request->id)->update([
                'value' => $request->value
            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}

















