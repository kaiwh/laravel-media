
@php

	$placeholder = Image::placeholder(100,100);

	if( old('image') ){
		$thumb = Image::resize(old('image'),100,100);
	}
	else{
		$thumb = $placeholder;
	}
	
@endphp
@extends('admin::layouts.app')

@section('content')

    <div id="content">
		<div class="container-fluid">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="page-header">
						<h1>@Lang('admin::mediaCategory.heading.create')</h1>
						<ul class="breadcrumb">
							<li><a href="{{ route('admin') }}">@Lang('admin::home.heading.title')</a></li>
							<li><a href="{{ route('admin.media.category.index') }}">@Lang('admin::mediaCategory.heading.index')</a></li>
							<li><a href="{{ route('admin.media.category.create') }}">@Lang('admin::mediaCategory.heading.create')</a></li>
						</ul>
						<div class="pull-right">
							<button type="submit" form="form" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="@Lang('admin::app.button.save')"><i class="fa fa-save"></i></button>
							<a href="{{ route('admin.media.category.index') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="@Lang('admin::app.button.cancel')"><i class="fa fa-reply"></i></a>
						</div>
					</div>
				</div>
				<div class="panel-body">
					@if (count($errors) > 0)
					    <div class="alert alert-danger"  role="alert">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					<form method="POST" action="{{ route('admin.media.category.create') }}" class="form-horizontal" id="form">
	            		{{ csrf_field() }}
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab-general" data-toggle="tab">@Lang('admin::app.tab.general')</a></li>
							<li class=""><a href="#tab-data" data-toggle="tab">@Lang('admin::app.tab.data')</a></li>
						</ul>
						<div class="tab-content">
				            <div class="tab-pane active" id="tab-general">
				            	@php
									$descriptions = [];
									if(old('descriptions')){
										$descriptions = old('descriptions');
									}
								@endphp
				            	@include('admin::media.category.description',['descriptions'=>$descriptions])
				            </div>
							{{-- End tab-general --}}
							<div class="tab-pane" id="tab-data">
								
								<input name="parent_id" value="{{ Request::get('parent_id') }}"  id="input-parent_id" class="form-control" type="hidden">

								<div class="form-group ">
									<label class="col-sm-2 control-label" for="input-image">@Lang('admin::mediaCategory.form.image')</label>
									<div class="col-sm-10">
										<a href="#" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="{{ $thumb }}" alt="" title="" data-placeholder="{{ $placeholder }}" /></a>
                  						<input type="hidden" name="image" value="{{ old('image') }}" id="input-image" />
									</div>
								</div>
								<div class="form-group ">
									<label class="col-sm-2 control-label" for="input-parent">@Lang('admin::mediaCategory.form.status')</label>
									<div class="col-sm-10">
										<select name="status" id="input-status" class="form-control" >
											@if( !is_null(old('status')) && old('status')==0 )
											<option value="1" >@Lang('admin::app.text.enabled')</option>
											<option value="0" selected="selected">@Lang('admin::app.text.disabled')</option>
											@else
											<option value="1" selected="selected">@Lang('admin::app.text.enabled')</option>
											<option value="0" >@Lang('admin::app.text.disabled')</option>
											@endif
										</select>
									</div>
								</div>
							</div>
							{{-- End tab-data --}}
	       				</div>
	       			</form>
				</div>			
			</div>
			
	    </div>
	</div>
    
@endsection

@push('scripts')

@endpush

@section('script')

@endsection