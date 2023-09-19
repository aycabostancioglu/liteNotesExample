@extends("front.layouts.master")


@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Burası detay sayfası</h1>

    <a class="btn btn-primary" href="{{route('notes_update',$note->id)}}">Güncelle</a>
</div>

<br>
<div class="bg-white p-3 rounded-3">
    <h2>{{$note->title}}</h2>
    <hr>
    <p>{{$note->content}}</p>

    <span class="text-muted">{{$note->updated_at->diffForHumans()}}</span>
</div>


@endsection
