<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Head Text Field -->
<div class="form-group col-sm-6">
    {!! Form::label('head_text', 'Head Text:') !!}
    {!! Form::text('head_text', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('questionTypes.index') !!}" class="btn btn-default">Cancel</a>
</div>
