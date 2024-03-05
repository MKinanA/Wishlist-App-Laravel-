<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index() {
        $data = Data::all();
        return view('index', compact(['data']));
    }

    public function create(Request $request) {
        Data::create([
            'img' => $request->file('img') != null ? file_get_contents($request->file('img')->getRealPath()) : null,
            'img_type' => $request->input('img_type') != null ? $request->input('img_type') : '',
            'name' => $request->input('name') != null ? $request->input('name') : '',
            'price' => $request->input('price') != null ? $request->input('price') : '',
            'desc' => $request->input('desc') != null ? $request->input('desc') : ''
        ]);
        return redirect('../#back');
    }

    public function delete(Request $request) {
        Data::find($request->input('id'))->delete();
        return redirect('../#back');
    }

    public function edit(Request $request) {
        return view('index', ['edit_data' => $request->all()]);
    }

    public function update(Request $request) {
        $data = Data::find($request->input('id'));
        $data->update([
            'img' => $request->file('img') != null ? file_get_contents($request->file('img')->getRealPath()) : (Data::find($request->input('id'))->img),
            'img_type' => $request->input('img_type') != null ? $request->input('img_type') : '',
            'name' => $request->input('name') != null ? $request->input('name') : '',
            'price' => $request->input('price') != null ? $request->input('price') : '',
            'desc' => $request->input('desc') != null ? $request->input('desc') : ''
        ]);
        return redirect('../#back');
    }
}
