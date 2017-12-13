@extends('layouts.master')
@section('content')
<div id="app">
    <div class="modal-content animated bounceInRight">
        <div class="modal-header">
            <h4 class="modal-title">Create Page</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(['id'=>'perform_page_create_Form', 'name'=>'perform_page_create_Form']) !!}
            <label>Link
                <div class="form-group">

                    {{ Form::text('link','',['placeholder'=>'Link',' class'=>'p-xs'])}}
                   </label>
                </div>
         
            <label>location Name
                <div class="form-group">

                    {{ Form::text('location_name','',['placeholder'=>'location name',' class'=>'p-xs'])}}
                </label>
                </div>
           
            <div class="form-group">
                <label>Select domain

                    <select name="domain" id="domain"  class="form-control input-sm">
                        <option value="" selected>select</option>
                        @foreach($domains as $domain)
                        <option class="input-group-sm" value="{{ $domain->id}}"></option>
                        {{ $domain->name}}
                        @endforeach
                    </select>
                </label>
            </div>
            <label>Category
                <div class="form-group">

                    {{ Form::text('category','',['placeholder'=>'category',' class'=>'p-xs'])}}
                 </label>
                </div>
           
            <label>area
                <div class="form-group">

                    {{ Form::text('area','',['placeholder'=>'area',' class'=>'p-xs'])}}
                     </label>
                </div>
      
            <label>Frequency
                <div class="form-group">

                    {{ Form::text('frequency','',['placeholder'=>'Frequency',' class'=>'p-xs'])}}
                     </label>
                </div>
       
            {!! Form::close() !!}
            <div class="clearfix">&nbsp;</div>
        </div>
        <div class="modal-footer">
            <div id='perform_page_create_Loader'> </div>
            <div id="perform_page_create_Results" class="success-element alert-info"></div>

            <button type="button" id="perform_page_create_Button" class="btn btn-primary">save</button>
        </div>
    </div>

</div>

@endsection