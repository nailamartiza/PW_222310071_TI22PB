<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Mahasiswa $mahasiswa){
        return view('TokoIBIK.modules.products.index', [
            "data" => $mahasiswa->all()
        ]);
    }

    public function getDataByID(Mahasiswa $mahasiswa){
        return view('TokoIBIK.modules.products.show', [
            "data" => $mahasiswa->all()
        ]);
    }

    public function store(Request $request){
        $validateData= $request->validate([
            'name'=>'required|max:40',
            'npm'=>'required|max:11',
            'email'=>'required|max:40',
        ]);

        Mahasiswa::create($validateData);

        return redirect('/')->with('success', 'Data sukses disimpan');
    }
}
