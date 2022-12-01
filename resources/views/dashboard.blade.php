@extends('layout1')

@section('content')
<div class="content">
<h1>Selamat Datang di Halaman Dashboard</h1>
<div class="fajar">
<h5>Username :{{ auth()->user()->name }}</h5>
<h5>Email :{{ auth()->user()->email }}</h5>
</div>
</div>

@endsection