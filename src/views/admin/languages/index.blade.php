@extends('layouts.app')

@section('content')


        <div class="col-md-12">

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="text-center">language</th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Remove</th>
                    </tr>
                    @foreach ($languages as $language)
                        <tr>
                            <td><a href="">{{ $language['iso_code'] }}</a></td>
                            <td class="text-right">{{ $language['id_lang'] }}</td>
                            <td class="text-right">{{ $language['name'] }}</td>
                         
                            <td class="text-center">
                                <form method="POST" action="{{ route('admin.languages.destroy', $language['id']) }}" accept-charset="UTF-8" role="form" onsubmit="return confirm('Do you really want to remove this language?');">
                                
                                    {{ csrf_field() }}

                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>


        </div>


        <div class="col-md-12">
            <a href="{{ route('admin.languages.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add new language</a><br /><br />
        </div>

@endsection