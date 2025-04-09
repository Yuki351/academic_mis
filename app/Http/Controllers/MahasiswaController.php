<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.index')
        -> with ('mahasiswas', Mahasiswa::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create')
        -> with('dosens', Dosen::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'nrp' => 'required|string|max:9|unique:mahasiswa, nrp',
            'nama' => 'requred|string|max:100',
            'email' => 'nullable|string|email|max:50|unique:mahasiswa, email',
            'birthdate' => 'requred|date',
            'address' => 'requred|string|max:300',
            'phone' => 'required|string|max:16',
            'profilePicture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'dosen_nik' => 'required|string|exists:dosen,nik'
        ])->validate();
        $mahasiswa = new Mahasiswa($validatedData);

        if ($request->hasFile('profilePicture')) {
            $newFileName = $validatedData['nrp'] . '.' . $request->file('profilePicture')->getClientOriginalExtension();
            $request->file('profilePicture')->storeAs('uploads', $newFileName);
            $mahasiswa['profilePicture']= $filename;
        }
        $mahasiswa->save();
        return redirect(route('mahasiswaList'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa = Mahasiswa::find($nrp);
        if ($mahasiswa == null) {
          return back()->withErrors(['err_msg' => 'mahasiswa not found!']);
        }
        return view('mahasiswaDetail')
          ->with('mahasiswa', $mahasiswa);
      }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $mahasiswa = Mahasiswa::find($nrp);
        if ($mahasiswa == null) {
          return back()->withErrors(['err_msg' => 'Mahasiswa not found!']);
        }
        return view('mahasiswaEdit')
          ->with('dosen', Dosen::all())
          ->with('mahasiswa', $mahasiswa);
      }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa = Mahasiswa::find($nrp);
        if ($mahasiswa == null) {
        return back()->withErrors(['err_msg' => 'mahasiswa not found!']);
        }
        $validatedData = $request->validate([
        'nrp' => ['required', 'string', 'max:9', Rule::unique('mahasiswa', 'nrp')->ignore($mahasiswa->nrp, 'nrp')],
        'name' => ['required', 'string', 'max:100'],
        'birth_date' => ['required'],
        'phone' => ['required', 'numeric'],
        'email' => ['nullable', 'email', 'max:50', Rule::unique('mahasiswa', 'email')->ignore($mahasiswa->nrp, 'nrp')],
        'address' => ['required', 'string', 'max:300'],
        'dosen_nik' => ['required', 'string'],
        'profilePicture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);
        $mahasiswa['name'] = $validatedData['name'];
        $mahasiswa['birth_date'] = $validatedData['birth_date'];
        $mahasiswa['phone'] = $validatedData['phone'];
        $mahasiswa['email'] = $validatedData['email'];
        $mahasiswa['address'] = $validatedData['address'];
        $mahasiswa['dosen_nik'] = $validatedData['dosen_nik'];
        if ($request->hasFile('profilePicture')) {
        unlink('storage/uploads/profilePicture' . $mahasiswa->profilePicture);
        $file = $request->file('profilePicture');
        $newFileName = $validatedData['nrp'] . '.' . $file->getClientOriginalExtension();
        $file->storePubliclyAs('mahasiswas_picture', $newFileName);
        $mahasiswa['profilePicture'] = $newFileName;
        }
        $mahasiswa->save();
        return redirect()->route('mahasiswaList')
        ->with('status', 'mahasiswa successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa = Mahasiswa::find($nrp);
        if ($mahasiswa == null) {
          return back()->withErrors(['err_msg' => 'mahasiswa not found!']);
        }
        if ($mahasiswa->profilePicture != null) {
          unlink('storage/uploads/profilePicture/' . $mahasiswa->profilePicture);
        }
        $mahasiswa->delete();
        return redirect()->route('mahasiswaList')
          ->with('status', 'mahasiswa successfully deleted!');
      }
    }
