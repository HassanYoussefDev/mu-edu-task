@extends('layouts.app')

@section('content')


<div class="container">
	<div class="row">
	    
	    <div class="col-md-8 col-md-offset-2">
	        
    		<h1>Create post</h1>
    		
    		<form action="{{ route('posts_store') }}" method="POST">

				@csrf
    		    
    		    <div class="form-group">
    		        <label for="title">Title <span class="require">*</span></label>
    		        <input type="text" class="form-control" name="title" required autofocus />
    		    </div>
    		    
    		    <div class="form-group">
    		        <label for="body">Body<span class="require">*</span></label>
    		        <textarea rows="5" class="form-control" name="body" required autofocus></textarea>
    		    </div>
    		    
    		    <div class="form-group">
    		        <p><span class="require">*</span> - required fields</p>
    		    </div>
    		    
    		    <div class="form-group">
    		        <button type="submit" class="btn btn-primary">
    		            Create
    		        </button>
    		        <button class="btn btn-default">
    		            Cancel
    		        </button>
    		    </div>
    		    
    		</form>
		</div>
	</div>


</div>
@endsection