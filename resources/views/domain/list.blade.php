 @extends('layouts.master')
@section('content')

<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
@if(null!=($domains))
@foreach($domains as $domain)
 
<div> Domain Name :{{$domain->name}}</div>
<div> Link :{{$domain->link}}</div>
<div> Long:{{$domain->long}}</div>
<div> Lat: {{$domain->lat}}</div>
</div>
 @endforeach
@endif
</div>
</div>
@endsection