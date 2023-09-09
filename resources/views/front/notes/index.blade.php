@extends("front.layouts.master")


@section('content')


    <a class="btn btn-success"  href="{{route('notes_createPage')}}">Not Oluştur</a>
    <br>
    <h1>Notlar</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    @if($notlar->count() > 0)
        @foreach($notlar as $not)
            <div class="bg-white border-b border-gray-200 shadow-sm:rounded-lg mb-3 p-3">
                    <h2 class="fs-2 fw-bold"><a class="text-black" style="text-decoration:none " href="{{route('notes_detail1',$not->id)}}" style="">{{$not->title}}</a></h2>
                    <p class="mt-3">{{Str::limit($not->content,200)}}</p>
                    <span class="block fs-6 text-muted opacity-75">{{$not->updated_at->diffForHumans()}}</span>
            </div>
        @endforeach

        <div class="d-flex justify-content-center">
            {{$notlar->links()}}
        </div>

    @else
        Henüz bir not kaydetmediniz.
    @endif



@endsection
