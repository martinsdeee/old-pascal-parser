<?php
    $code = isset($input['code']) ? $input['code'] : "";
?>

@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <h1>
                Pascal Parser
            </h1>
            {{ Form::open(['route'=>'parser.store']) }}
            <!-- Code Field -->
            <div class="form-group">
                {{ Form::label('code', 'Code') }}
                {{ Form::textarea('code', $code, ['class' => 'form-control', 'required' => 'required']) }}
            </div>
            <!-- Submit Field -->
            <div class="form-group text-center">
                {{ Form::submit('Analizēt kodu', ['class' => 'btn btn-success']) }}
            </div>
            {{Form::close()}}
        </div>
    </div>
    @if(isset($tables))
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <pre>
<?php var_dump($tables); ?>
            </pre>
        </div>
    </div>
    @endif
@stop
