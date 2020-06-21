<!-- Docx File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('docx_file', 'Docx File:') !!}
    {!! Form::text('docx_file', null, ['class' => 'form-control']) !!}
</div>

<!-- Pdf File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pdf_file', 'Pdf File:') !!}
    {!! Form::text('pdf_file', null, ['class' => 'form-control']) !!}
</div>

<!-- Header Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('header_title', 'Header Title:') !!}
    {!! Form::text('header_title', null, ['class' => 'form-control']) !!}
</div>

<!-- Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duration:') !!}
    {!! Form::text('duration', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Marks Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_marks', 'Total Marks:') !!}
    {!! Form::text('total_marks', null, ['class' => 'form-control']) !!}
</div>

<!-- Daytime Field -->
<div class="form-group col-sm-6">
    {!! Form::label('daytime', 'Daytime:') !!}
    {!! Form::text('daytime', null, ['class' => 'form-control']) !!}
</div>

<!-- Exam Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('exam_date', 'Exam Date:') !!}
    {!! Form::text('exam_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Questions Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('questions_count', 'Questions Count:') !!}
    {!! Form::text('questions_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Pages Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pages_count', 'Pages Count:') !!}
    {!! Form::text('pages_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Header Instructions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('header_instructions', 'Header Instructions:') !!}
    {!! Form::text('header_instructions', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('exams.index') !!}" class="btn btn-default">Cancel</a>
</div>
