<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;

class PagesController extends Controller
{
    public function index()
    {
        return view('admin.pages.list');
    }
    public function create()
    {
        return view('admin.pages.create');
    }
    public function edit($id)
    {
        return view('admin.pages.edit', [
            'page' => Pages::where('id', $id)->firstOrFail(),
        ]);
    }
    public function destroy($id)
    {
        Pages::find($id)->delete();
        return back()->with('success','Post deleted successfully');
    }
}
