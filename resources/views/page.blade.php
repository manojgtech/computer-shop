@extends('layouts.home')

@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$title}}</h1>
                {!! $content !!}
            </div>
        </div>
    </div>
</main>

@endsection