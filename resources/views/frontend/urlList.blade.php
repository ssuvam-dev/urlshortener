@extends('frontend.layout.main')
@section('title','URLS')
@section('main-section')

	<div class="container mt-5 mt-5">

		@if(session('message'))
			<h5 class="alert alert-danger">{{session('message')}}</h5>
		@endif
		<div class="card mb-4">
              <div class="card-header d-flex">
              		
              	 <form action="{{route('url.details')}}" class="d-flex float-right" role="search">
        	<input class="form-control me-2" name='search' type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
                                
                </div>
         <div class="card-body">
	<table class="table">
  <thead>
    <tr>
      <th>Name </th>
      <th scope="col">Original Url</th>
      <th scope="col">Short Url</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	@if($total != 0)
    @foreach($urls as $url)
		<tr>
			<td>{{$url->name}}</td>
			<td><a href="{{$url->original_url}}">{{$url->original_url}}</a></td>
			<td>{{$url->short_url}}</td>
			<td><a href="{{route('url.short',$url->short_url)}}"><button class="btn btn-secondary">Visit</button></a> <a href="{{route('url.delete',$url->id)}}"><button class="btn btn-danger">Delete</button></a></td>
		</tr>
		@endforeach
  </tbody>
</table>
</div>
<div class="d-flex justify-content-between mb-4">
	<span>Showing {{$urls->firstItem()}} to {{$urls->lastItem()}} of {{$total}} entries</span>
 <p class="justify-content-between">{{$urls->links()}}</p>
 @else
 	<tr>
 		<td colspan="4" class="text-center"><b>NO DATA FOUND Click here to <a href="{{route('url.details')}}">refresh</a>. OR Click here to <a href="{{route('home')}}">add</a> urls.</b></td>
 	</tr>
 @endif
</div>
</div>
</div>
@endsection