@extends('frontend.layout.main')
@section('title','Home')
@section('main-section')
<div class="page-hero text-center text-light">
                <div class="container mx-auto">
                   
                    <div class="brand-quote">
                        <h3 class="fs-1 text-primary">Shorten your URL!</h3>
                    </div>
                    <div class="brand-caption">
                        <p class="fs-3 text-dark">Shorten your url and share to people around you.</p>
                    </div>
                    

                    <div class="search-box">
                        <form action="{{route('url.create.short')}}" method="POST">
                        	@csrf
                           <div class="input-group mb-3">
                 <input type="text" class="form-control" placeholder="Enter your url here" aria-label="Recipient's username" aria-describedby="button-addon2" name="original_url">
                 @if(Auth::check())
<input type="text" class="form-control ml-1" placeholder="Name your URL" name="url_name">
                 @endif
                <input class="btn btn-outline-primary" type="submit" id="button-addon2" value="Create">
</div>
                        </form>
                        @error('original_url')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
        @if(session('message'))
            <h5 class="alert alert-success">{!!session('message')!!}</h5>
        @endif

                </div>
            </div>
        </section>
    </div>
@endsection