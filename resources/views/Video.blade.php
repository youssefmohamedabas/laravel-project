@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                 
                    Video Viewer({{$video ->viewer}})
                        </div>
                   
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/GVNDbTwOSiw?si=SBF2vzrsHP0SND9C" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
