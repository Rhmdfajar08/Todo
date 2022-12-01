@extends ('layout1')

@section('content')

    <form action="/store" method="POST" style="max-width: 500px; margin:auto; background-color: ;">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @csrf
        <div class="d-flex flex-column mt-4">
            <label>Title</label>
            <input type="text" name="title">
        </div>
        <div class="d-flex flex-column"></div>
            <label>date</label>
            <input type="date" name="date">
        </div>
        <div class="d-flex flex-column">
            <label>Description</label>
            <textarea name="description" cols="30" rows="5" class="text-dark"></textarea>
        </div>
        <button type="submit">Kirim</button>
    </form>

@endsection