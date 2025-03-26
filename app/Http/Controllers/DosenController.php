<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\validation\Rule;

class DosenController extends Controller
{
    /* Display a listing of the resource.*/
    public function index()
    {
        return view('dosen.index')
        -> with ('dosens', Dosen::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'nik' => 'required|string|max:7|unique:dosen, nik',
            'nama' => 'requred|string|max:100',
            'email' => 'requred|string|email|max:50|unique:dosen, email',
            'birthdate' => 'requred|date'
        ])->validate();
        $dosen = new Dosen($validatedData);
        $dosen->save();
        return redirect(route('dosenList'))
        ->with('status', 'Dosen successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        $dosen = Dosen::find($nik);
        if ($dosen == null) {
            return back()->withErrors(['err_msg' => 'Dosen not found!']);
        }
        return view('dosenEdit')
            ->with('dosen', $dosen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $dosen = Dosen::find($nik);
        if ($dosen == null) {
            return back()->withErrors(['err_msg' => 'Dosen not found!']);
        }
        $validatedData = validator($request->all(),[
            'nik' => ['required', 'string', 'max:7', Rule::unique('dosen', 'nik')->ignore($dosen->nik, 'nik')],
            'name' => ['required', 'string', 'max:100'],
            'birthdate' => ['required'],
            'email' => ['required', 'email', 'max:50', Rule::unique('dosen', 'email')->ignore($dosen->nik, 'nik')],
        ])->validate();
        $dosen['name'] = $validatedData['name'];
        $dosen['birthdate'] = $validatedData['birthdate'];
        $dosen['email'] = $validatedData['email'];

        $dosen->save();
        return redirect()->route('dosenList')
            -> with('success', 'Dosen Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect(route('dosenList'))->with('success', 'Dosen Berhasil Dihapus');
    }
}
