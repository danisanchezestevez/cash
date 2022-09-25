@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Category</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories-list') }}"> Back</a>
            </div>
        </div>
    </div>
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ $category->name }}</div>
                        <div class="card-body">{{ $category->detail }}</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <hr>
                    {!! Form::open(array('route' => 'answers-save','method'=>'POST','id' => 'formCategory')) !!}
                    {{ Form::hidden('category_id', $category->id) }}
                    @foreach($questionscategories as $questioncategory)
                    <div class="card">
                            <div class="card-header">
                                {{$questioncategory['name']}}
                            </div>
                            <div class="card-header">
                                @php
                                    $type=$questioncategory['type'];
                                @endphp
                                @if($type==$TYPE_SELECT)
                                    {!! Form::select($questioncategory['name'], $questioncategory['values'], null, array('placeholder' => $questioncategory['name'],'id' => $questioncategory['name'], $questioncategory['required'],'class' => 'form-control')) !!}
                                @else
                                    {!! Form::$type($questioncategory['name'], null,array('placeholder' => $questioncategory['name'],'id' => $questioncategory['name'], $questioncategory['required'],'class' => 'form-control')) !!}
                                @endif
                            </div>
                    </div>
                    @endforeach
                    <div class="col-md-8">
                        <br>
                        <button id="submitAnswer" type="button" class="btn btn-primary" >Submit</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#Marca').change(function(e) {

            var brand_id = this.value

            e.preventDefault();

            $.ajax({
                url : '/getModelsByBrand',
                data : { brand_id : brand_id },
                type : 'POST',
                success : function(response) {
                    $("#Modelo").attr('disabled', false);
                    var $select = $('#Modelo');

                    $select.find('option').remove();
                    $.each(response,function(key, value)
                    {
                        $select.append('<option value=' + key + '>' + value + '</option>'); // return empty
                    });
                },
            });

        });

        $('#submitAnswer').click(function(e) {
            e.preventDefault();
            if($("#IMEI")){
                var IMEI = $("#IMEI").val();
                if(IMEI.length > 15) {
                    alert('EL IMEI no puede ser mayor de 15 caracteres');
                    return;
                }
            }
            $('#formCategory').submit();
        });
    </script>

@endsection

