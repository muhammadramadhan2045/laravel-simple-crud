<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'mahasiswa.index')->with(
            ['mahasiswa' => mahasiswa::all(),]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate( [
            'nim' => 'required|min:9|max:15',
            'nama' => 'required',
            'jurusan' => 'required',
        ]);
        
        $mahasiswa= new Mahasiswa;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->jurusan = $request->jurusan;
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')->with(
            ['message' => 'Data Mahasiswa Berhasil Disimpan']
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        // $mahasiswa = Mahasiswa::find($id); //mencari data berdasarkan id
        return view('mahasiswa.edit')->with(
            ['mahasiswa' => mahasiswa::find($id)]
        ); //menampilkan halaman edit dengan data mahasiswa yang akan di edit
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request -> validate( [
            'nim' => 'required|min:9|max:15',
            'nama' => 'required',
            'jurusan' => 'required',
        ]);
        
        $datamahasiswa=$request->all();
        $mahasiswa=Mahasiswa::find($id);
        $mahasiswa->nim = $datamahasiswa['nim'];
        $mahasiswa->nama = $datamahasiswa['nama'];
        $mahasiswa->jurusan = $datamahasiswa['jurusan'];
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')->with(
            ['message' => 'Data Mahasiswa Berhasil Diedit']
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete data
        Mahasiswa::find($id)->delete();
        return redirect()->route('mahasiswa.index')->with(
            ['message' => 'Data Mahasiswa Berhasil Dihapus']
        );
    }
}