<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan halaman awal dan semua data
        return view('login1');
        
    }
    public function registerPage(){
        return view('register');
    }
    
    public function dashboard()
    {
        return view('dashboard');
    }

    public function register(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $validateData['password'] = bcrypt($request->password);

        User::create($validateData);

        return redirect('/');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //menampilkan halaman form input tambah data
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
        'title' => 'required|min:3',
        'date' => 'required',
        'description' => 'required|min:8'
       ]);
        //mengirim data baru ke data base


        Todo::create([
            'title' =>$request->title,
            'date' =>$request->date,
            'description' => $request->description,
            'user_id'=> Auth::user()->id,
            'status'=> 0,            
        ]);

        return redirect('/dashboard')->with('addTodo','Berhasil menambahkan data Todo!');
       }
       public function data()
       {
        //ambil data dari table todos
        $todos = Todo::all();
        //compact untuk mengirim data ke bladenya
        //isi di compact harus sama kaya nama variablenya
        return view('data',compact('todos'));
       }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //menampilkan satu data spesifik
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //parameter $id mengambil data path dinamis {id}
        // ambil satu baris data yang memiliki value colum id sama dengan data path dinamis id yang dikirim ke route
        $todo = Todo::where('id',$id)->first();
        // 
        return view('edit', compact('todo'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //mengupdate data di database
        $request ->validate([
        'title' => 'required|min:3',
        'date' => 'required',
        'description' => 'required|min:8'
        ]);

        Todo::where('id', $id)->update([
        'title' =>$request->title,
        'date' =>$request->date,
        'description' => $request->description,
        'user_id'=> Auth::user()->id,
        'status'=> 0,  
        ]);

        return redirect('/data')->with('succesUpdate', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::where('id', $id)->delete();
        //menghapus data yang ada di database
        return redirect('/data')->with('succesDelete', 'Berhasil Menghapus Data Todo!');
    }

    public function updateToComplated(Request $request, $id)
    {
    Todo::where('id', '=', $id)->update([
        'status' => 1,
        'done_time' => \carbon\carbon::now(),
    ]);
    return redirect()->back()->with('done', 'Todo telah selesai dikerjakan!');
    }
}
