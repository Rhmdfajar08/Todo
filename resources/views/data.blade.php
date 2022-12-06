@extends('layout1')

@section('content')
 @if (session('succesUpdate'))
 <div class = "alert alert-succes">
    {{session('succesUpdate')}}
 </div>
 @endif
 @if (session('succesDelete'))
 <div class = "alert alert-succes">
    {{session('succesDelete')}}
 </div>
 @endif
 @if (session('addTodo'))
 <div class = "alert alert-succes">
    {{session('addTodo')}}
 </div>
 @endif
 @if (session('done'))
 <div class = "alert alert-succes">
    {{session('done')}}
 </div>
 @endif
<table class="table table-dark table-striped">
    <tr>
        <td>No</td>
        <td>Kegiatan</td>
        <td>Deskripsi</td>
        <td>Batas waktu</td>
        <td>Status</td>
        <td>Aksi</td>
    </tr>
    @php
    $no = 1;
    @endphp
    @foreach ($todos as $todo)
    <tr>
            {{-- tiap di looping,$no bakal di tambah 1 --}}
        <td>{{ $no++ }}</td>
        <td>{{ $todo['title'] }}</td>
        <td>{{ $todo['description'] }}</td>
            {{-- carbon : package data pada laravel. nntinya si data yg 2022-11-22 formatnya jadi 22 nov,2022 --}}
        <td>{{\carbon\carbon::parse($todo['date'])->format('j F,Y')}}</td>
        <td>{{$todo['status'] ? 'complated' : 'On-Process'}}</td>
        <td class="d-flex gap-2">
            <a href="/edit/{{$todo['id']}}" class="btn btn-primary mr-0">Edit</a> 
            <form action="/delete/{{$todo['id']}}" method="POST">
                @csrf
                {{-- Menyimpan method="POST", karena di route nya menggunakan methode delete --}}
                @method('DELETE')
                <button type="submit" class="btn btn-danger">delete</button>
            </form>
            {{-- button hanya muncul ketika statusnya masih on-process (0)--}}
            @if ($todo['status'] == 0)
            <form action="/complated/{{$todo['id']}}" method="POST">
            @csrf
            @method('patch')
            <button type="submit" class="btn btn-warning"> complated</button>
            </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection