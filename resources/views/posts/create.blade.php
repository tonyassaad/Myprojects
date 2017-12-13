@extends('layouts.master')
@section('content')
<div id="app">
    <div class="modal-content animated bounceInRight">
        <div class="modal-header">
            <h4 class="modal-title">Create Page</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(['id'=>'perform_posts_create_Form', 'name'=>'perform_posts_create_Form']) !!}
            <label>title
                <div class="form-group">

                    {{ Form::text('title','',['placeholder'=>'title',' class'=>'p-xs'])}}
                   </label>
                </div>
         
            <label>location Name
                <div class="form-group">

                    {{ Form::text('image','',['placeholder'=>'image',' class'=>'p-xs'])}}
                </label>
                </div>
            <label>body
                <div class="form-group">

                    {{ Form::text('body','',['placeholder'=>'body',' class'=>'p-xs'])}}
                </label>
                </div>
     
            {!! Form::close() !!}
            <div class="clearfix">&nbsp;</div>
        </div>
        <div class="modal-footer">
            <div id='perform_posts_create_Loader'> </div>
            <div id="perform_posts_create_Results" class="success-element alert-info"></div>

            <button type="button" id="perform_posts_create_Button" class="btn btn-primary">save</button>
        </div>
    </div>

</div>

@endsection