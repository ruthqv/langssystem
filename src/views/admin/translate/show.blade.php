

@for ($i =0; $i< count($langscount); $i++)

<input type="hidden" value="$value['id']" name="id_lang" class="id_lang">

    <div class="traducibles{{$field['name']}} form-group{{ $errors->has('$field["name"]') ? ' has-error' : '' }}" name="langsnames">
        {{ csrf_field() }}
        <label for="{{ $langscount[$i]['$field[name]']  }}" class="control-label @if($field['nonullable'] ==false ) required @endif">{{$field['name']}}-{{ $langscount[$i]['name'] }} : </label>

        @if($field['type'] == 'string')
        <input  data-input="{{ $langscount[$i]['iso_code']  }}" type="text"  class="form-control" id="{{$field['name']}}{{ $langscount[$i]['iso_code']  }}" name="lang[{{$field['name']}}][{{ $langscount[$i]['id_lang']  }}]" value="@if(isset($entity->langstab[$i][$field['name']])){!! $entity->langstab[$i][$field['name']]!!} @endif"  @if($field['nonullable'] ==false ) required @endif    maxlength="{{$field['lenght']}}" />

        @else
        <textarea  data-input="{{ $langscount[$i]['iso_code']  }}"  class="ckeditor" id="{{$field['name']}}{{ $langscount[$i]['iso_code']  }}" name="lang[{{$field['name']}}][{{ $langscount[$i]['id_lang']  }}]" value="@if(isset($entity->langstab[$i][$field['name']])){!! $entity->langstab[$i][$field['name']]!!}@endif" @if($field['nonullable'] ==false ) required @endif   maxlength="{{$field['lenght']}}" />@if(isset($entity->langstab[$i][$field['name']])){!!html_entity_decode($entity->langstab[$i][$field['name']])!!}@endif</textarea>
        @endif

        @include('snippets.errors_first', ['param' => '$field["name"]'])
    </div>

@endfor

@if(env('LANGS'))
 @section('scripts')
    <script>

$(document).ready(function(){

console.log('langs-edit.active');

$('input#uri').on('focus',function(){

  namefilluri = $('.namefortrans').val();
  uriclean = getCleanedString(namefilluri);
  // console.log(uriclean);
  $(this).val(uriclean);

});
$('.traduciblesuri input').on('input',function(){
  $(this).removeClass('alert-danger');
});

$('.traduciblesuri input').on('blur',function(){
  var id = $('.form').data('id');
  var id_lang= $('.id_lang').val();
  var type = $('.form').data('type');
  var uri = $(this).val();
  uriclean = getCleanedString(uri);

    $.ajax({
      headers: {
      'X-CSRF-Token': $('meta[name="_token"]').attr('content')
      },
      url: baseurl + "admin/controlurislang",
      type: "POST",
      context: this,
      data: {
      uriclean: uriclean,
      type:type,
      id: id,
      id_lang:id_lang,
      },
      cache: false,
      success: function(data) {
        if(data == 'exist'){
          $(this).val('');
          $(this).attr('placeholder','You cannot choose this uri, because it exists already.').addClass('alert-danger').focus();
        }else{
            $(this).val(uriclean).removeClass('alert-danger');

        }
      },
       error: function() {}
      });

});


$('.traduciblesname input').on('focus',function(){
  var value = $(this).attr('value');
  var totrans = $('.namefortrans').val();

  // $('.namefortrans').change(function(){
  console.log(value);
  // });


  // if(value == '' ){

  var idioma = $(this).attr('id');
  var input = $(this).data('input');
  // alert(idioma+input);

   var totrans = $('.namefortrans').val();
   var key = 'trnsl.1.1.20170723T042632Z.845e1bee8f6a0401.a8b1b043fc143c62c15085dcdbb8f328d82871bf';
   var lang = 'es-' + input;  ;
   var format = 'plain';



       //console.log(valuetosearch);
     var path = "https://translate.yandex.net/api/v1.5/tr/translate";
     var data ={
      "text": totrans, "key": key, "lang": lang, "format": format,
    }
    $.post(
      path,
      data,
      function(response){
            var xml = response;
             var xmlDOM = new DOMParser().parseFromString(xml, 'text/xml');
             toj=xmlToJson(xmlDOM);

             // console.log(toj.Translation.text['#text']);

             $('#name'+ input).val(toj.Translation.text['#text']);
        },
        'text'
    );
  // }


  });





$('.traduciblesdescription input').on('focus',function(){
  var value = $(this).attr('value');
  var totrans = $('.descriptionfortrans').val();


  // if(value =='' ){


  var idioma = $(this).attr('id');
  var input = $(this).data('input');
  // alert(idioma+input);

   var totrans = $('.descriptionfortrans').val();
   var key = 'trnsl.1.1.20170723T042632Z.845e1bee8f6a0401.a8b1b043fc143c62c15085dcdbb8f328d82871bf';
   var lang = 'es-' + input;  ;
   var format = 'plain';



       //console.log(valuetosearch);
     var path = "https://translate.yandex.net/api/v1.5/tr/translate";
     var data ={
      "text": totrans, "key": key, "lang": lang, "format": format,
    }
    $.post(
      path,
      data,
      function(response){
            var xml = response;
                    var xmlDOM = new DOMParser().parseFromString(xml, 'text/xml');
              toj=xmlToJson(xmlDOM);
              // console.log(toj.Translation.text['#text']);
                        $('#description'+ input).val(toj.Translation.text['#text']);
        },
        'text'
    );
  // }


  });

$('.traduciblesdelivery_time input').on('focus',function(){
  var value = $(this).attr('value');
  var totrans = $('.delivery_timefortrans').val();


  if(value =='' ){


  var idioma = $(this).attr('id');
  var input = $(this).data('input');
  // alert(idioma+input);

   var totrans = $('.delivery_timefortrans').val();
   var key = 'trnsl.1.1.20170723T042632Z.845e1bee8f6a0401.a8b1b043fc143c62c15085dcdbb8f328d82871bf';
   var lang = 'es-' + input;  ;
   var format = 'plain';



       //console.log(valuetosearch);
     var path = "https://translate.yandex.net/api/v1.5/tr/translate";
     var data ={
      "text": totrans, "key": key, "lang": lang, "format": format,
    }
    $.post(
      path,
      data,
      function(response){
            var xml = response;
                    var xmlDOM = new DOMParser().parseFromString(xml, 'text/xml');
              toj=xmlToJson(xmlDOM);
              // console.log(toj.Translation.text['#text']);
                        $('#delivery_time'+ input).val(toj.Translation.text['#text']);
        },
        'text'
    );
  }


  });

});

//FUNCTION XML TO JSON
function xmlToJson(xml) {

  // Create the return object
  var obj = {};

  if (xml.nodeType == 1) { // element
    // do attributes
    if (xml.attributes.length > 0) {
    obj["@attributes"] = {};
      for (var j = 0; j < xml.attributes.length; j++) {
        var attribute = xml.attributes.item(j);
        obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
      }
    }
  } else if (xml.nodeType == 3) { // text
    obj = xml.nodeValue;
  }

  // do children
  if (xml.hasChildNodes()) {
    for(var i = 0; i < xml.childNodes.length; i++) {
      var item = xml.childNodes.item(i);
      var nodeName = item.nodeName;
      if (typeof(obj[nodeName]) == "undefined") {
        obj[nodeName] = xmlToJson(item);
      } else {
        if (typeof(obj[nodeName].push) == "undefined") {
          var old = obj[nodeName];
          obj[nodeName] = [];
          obj[nodeName].push(old);
        }
        obj[nodeName].push(xmlToJson(item));
      }
    }
  }
  return obj;
};

//FUNCTION CLEANSTRING(FOR URI AUTOFILLABLE)
function getCleanedString(cadena){
   // Definimos los caracteres que queremos eliminar
   var specialChars = "*!¡@#$^&%*()+=[]\/{}|:<>?,.";

   // Los eliminamos todos
   for (var i = 0; i < specialChars.length; i++) {
       cadena= cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
   }

   // Lo queremos devolver limpio en minusculas
   cadena = cadena.toLowerCase();

   // Quitamos espacios y los sustituimos por -
   cadena = cadena.replace(/ /g,"-");

   // Quitamos acentos y "ñ".
   cadena = cadena.replace(/á/gi,"a");
   cadena = cadena.replace(/é/gi,"e");
   cadena = cadena.replace(/í/gi,"i");
   cadena = cadena.replace(/ó/gi,"o");
   cadena = cadena.replace(/ú/gi,"u");
   cadena = cadena.replace(/ñ/gi,"n");
   cadena = cadena.replace(/ç/gi,"c");

   //quitamos numeros
   cadena = cadena.replace(/0/gi,"");
   cadena = cadena.replace(/1/gi,"");
   cadena = cadena.replace(/2/gi,"");
   cadena = cadena.replace(/3/gi,"");
   cadena = cadena.replace(/4/gi,"");
   cadena = cadena.replace(/5/gi,"");
   cadena = cadena.replace(/6/gi,"");
   cadena = cadena.replace(/7/gi,"");
   cadena = cadena.replace(/8/gi,"");
   cadena = cadena.replace(/9/gi,"");
   return cadena;
}

    </script>
@endsection
@endif
