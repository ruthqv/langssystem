@extends('admin.index')
@section('previous')
<a type="submit" href="{{ route('admin.home') }}" class="btn btn-sm btn-primary" target="_blank" title="SHOP"><i class="fa fa-angle-left"></i> SHOP</a>
<h1>You are translating chains for {{$lang}} language</h1>


@endsection
@section('maincontent')
           
 <p class="help-block">The input content will be show in the chain for this language</p>
<form method="POST" action="{{ route('admin.translate', $lang) }}" accept-charset="UTF-8" role="form" class="form-group">
{{ csrf_field() }}

@foreach ($lines as $key=>$value)

<label for="{{$key}}">{{$key}}</label>
<input type="text" placeholder="{{!! $value !!}}" value="{{ $value }}" name="{{$key}}" class="form-control">	
<br>		
@endforeach
<button type="submit" class="btn btn-success">Send</button>
</form>

<form method="POST" action="{{ route('admin.translate.add') }}" accept-charset="UTF-8" role="form" class="form-group">
{{ csrf_field() }}
<hr>
<h1>Adding new chain</h1>
<p class="help-block">The input content will be add to use in al views. Contact with web administrator to add this chain in the file or section you need add</p>


<input type="text" name="newkey" value="" placeholder="add new strings" required class="form-control">
<button type="submit" class="btn btn-success">Send</button>

<p class="help-block"> Developer info rule to add in views { {  __('chain') } } </p>
</form>



    @endsection


