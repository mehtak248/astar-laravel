@extends('layouts.admin.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage questions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.questions.index') }}">Manage questions</a></li>
                        <li class="breadcrumb-item active">Add Project</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
			    <div class="col-md-12">
			        <div class="card card-default">
			            <div class="card-header">
			                <h3 class="card-title">Add Question</h3>
			            </div>
			            <div class="card-body p-5">
		            	    {!! Form::open(['name'=>'add_edit_question_form', 'id'=>'add_edit_question_form', 'route' => 'admin.questions.store', 'method' => 'post']) !!}
						        <div class="row">
						            <div class="col-md-12">
						                <div class="card">
						                    <div class="card-body">
						                        @if ($errors->any())
						                            <div class="alert alert-danger">
						                                <ul>
						                                    @foreach ($errors->all() as $error)
						                                        <li>{{ $error }}</li>
						                                    @endforeach
						                                </ul>
						                            </div>
						                        @endif
						                        <div class="row">
						                            <div class="col-md-12">
						                                <div class="form-group">
						                                    <label for="question">Question Title *</label>
						                                    <textarea name="question" id="question" class="form-control text-editor" rows="2" cols="3"></textarea>
						                                    <span class="text-danger"></span>
						                                </div>
						                            </div>
						                        </div>
						                        <div class="wrapper-options">
						                        	<div class="row add-option-row">
													    <div class="col-md-6">
													        <div class="form-group">                    
													            <label for="option_details">Option Title *</label>                    
													            <input class="form-control" name="option_details[0][title]" type="text" value="" required="">                    
													            <span class="text-danger"></span>                
													        </div>
													    </div>
													    <div class="col-md-1">
													        <div class="form-group">
													            <label for="option_details">Score *</label>
													            <input class="form-control valid" name="option_details[0][score]" value="0" aria-invalid="false" required>
													            <span class="text-danger"></span>
													        </div>
													   </div>
													   <div class="col-md-3">
													        <div class="form-group">
													            <label>&nbsp;</label>                    
													            <div class="checkbox">
													                <label>
													                    <input type="checkbox" class="chk-correct-ans" name="option_details[0][is_correct]" value="1" checked="checked">
													                    <span>Is this correct answer ? </span>
													                </label>
													                <span class="text-danger"></span>
													            </div>
													        </div>
													   </div>
													   <div class="col-md-2">
													        <div class="form-group">
													            <label>&nbsp;</label>    
													            <button type="button" class="form-control btn btn-outline-success btn-xs btn-add-option float-right" title="Add New Options"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add Options</button>
													        </div>
													   </div>
													</div>
						                        </div>
						                    </div>
						                    <div class="card-footer">
						                        <div class="form-group">
						                            <a href="{{ url('questions') }}" class="btn btn-default float-right">Cancel</a>
						                            {!! Form::submit('Save',['class'=>'btn btn-primary float-right mr-1']) !!}
						                        </div>
						                    </div>
						                </div>
						            </div>
						        </div>
						    {!! Form::close() !!}
			            </div>
		            </div>
			    </div>
			</div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@push('script')
	<script type="text/javascript" src="{{ asset('assets/js/question.js') }}"></script>
@endpush