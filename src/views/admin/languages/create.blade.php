@extends('admin.index')
@section('previous')
<a type="submit" href="{{ route('admin.languages.index') }}" class="btn btn-sm btn-primary" title="Go back"><i class="fa fa-angle-left"></i> GO BACK </a>
<h2>Create new Language</h2>
@endsection
@section('maincontent')

            <form method="POST" action="{{ route('admin.languages.store') }}" accept-charset="UTF-8" enctype="multipart/form-data" role="form">
               
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-12 col-md-6">


                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label required">Language nombre:</label>

                            <input type="text" id="name" class="form-control" name="name" value="" maxlength="255" required />

                            @include('snippets.errors_first', ['param' => 'name'])
                        </div>
  
                        <div class="hide">
  
                        <div class="form-group{{ $errors->has('id_lang') ? ' has-error' : '' }}">
                            <label for="id_lang" class="control-label required">Language numero:</label>
                          @foreach($langsIds as $lang)


                            {{$lang['id_lang']}} 


                          @endforeach
                            <input type="text" id="id" class="form-control" name="id" value="@if(isset($lang['id_lang'])){{$lang['id_lang']+1}} @else 1 @endif"/>

                            <input type="text" id="id_lang" class="form-control" name="id_lang" value="@if(isset($lang['id_lang'])){{$lang['id_lang']+1}} @else 1 @endif"/>                          
                        </div>
  




                            @include('snippets.errors_first', ['param' => 'id_lang'])
                        </div>

                        <div class="form-group{{ $errors->has('iso_code') ? ' has-error' : '' }}">
                            <label for="iso_code" class="control-label">Language Iso Code</label>
                                                        
                            <select id="iso_code" class="form-control " name="iso_code">

                            </select>    

                            @include('snippets.errors_first', ['param' => 'iso_code'])
                        </div>
    
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" title="Create this new Language"><i class="fa fa-save"></i> Submit</button>

                            <a href="{{ route('admin.languages.index') }}" title="Click here to cancel">Cancel</a>
                        </div>

                      
                    </div>
                </div>

            </form>
    

@endsection

@section('scripts')
<script>
$(document).ready(function(){
    var key = 'trnsl.1.1.20170723T042632Z.845e1bee8f6a0401.a8b1b043fc143c62c15085dcdbb8f328d82871bf';
     var path = "https://translate.yandex.net/api/v1.5/tr.json/getLangs?ui=es";
     var data ={
       "key": key,
    }
     $.post(
      path,
      data,
      function(response){
            html = '';
            html += '<option value="">Select</option>';
            var arr= new Array();
            $.each( response.langs, function(key, val){
                html +='<option value="'+ key +'" required>'+ key +' - '+ val + ' </option>';
                });

            $('#iso_code').html(html);
        },
        'json'
    );

    
});
    
</script>
@endsection