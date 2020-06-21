<!-- Question Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question', 'Question:') !!}
    {!! Form::text('question', null, ['class' => 'question form-control']) !!}
</div>

<!-- Ilos Field -->
<div class="form-group col-sm-6">

    <label for="exampleInputFile">ILOs Standrad</label>
    <select name="ilos" class="ilos form-control" style="font-size: 20px; height: 100%;">
        <option value="">Type in the Question to detrmine or choose</option>
        <option value="knowledge">Knowledge and understanding</option>
        <option value="intellectual">Intellectual skills</option>
        <option value="practical">Professional and practical skills</option>
        <option value="transferable">General and transferable skills</option>
    </select>
</div>

<!-- Marks Field -->
<div class="form-group col-sm-6">
    {!! Form::label('marks', 'Marks:') !!}
    {!! Form::text('marks', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject_id', 'Subject Id:') !!}
    {!! Form::text('subject_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_id', 'Type Id:') !!}
    {!! Form::text('type_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Topic Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('topic_id', 'Topic Id:') !!}
    {!! Form::text('topic_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Choice1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('choice1', 'Choice1:') !!}
    {!! Form::text('choice1', null, ['class' => 'form-control']) !!}
</div>

<!-- Choice2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('choice2', 'Choice2:') !!}
    {!! Form::text('choice2', null, ['class' => 'form-control']) !!}
</div>

<!-- Choice3 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('choice3', 'Choice3:') !!}
    {!! Form::text('choice3', null, ['class' => 'form-control']) !!}
</div>

<!-- Choice4 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('choice4', 'Choice4:') !!}
    {!! Form::text('choice4', null, ['class' => 'form-control']) !!}
</div>

<!-- Answer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('answer', 'Answer:') !!}
    {!! Form::text('answer', null, ['class' => 'form-control']) !!}
</div>

<!-- Correct Field -->
<div class="form-group col-sm-6">
    {!! Form::label('correct', 'Correct:') !!}
    {!! Form::text('correct', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('questions.index') !!}" class="btn btn-default">Cancel</a>
</div>

@push('scripts')
    <script type="text/javascript">

  $('.question').on('change', function() {

    keywords =
    {
      knowledge : ['define', 'mention', 'list', 'describe', 'what is', 'where are', 'what are',],
      intellectual : ['explain', 'express', 'stablish', 'analyze', 'draw', 'state'],
      practical : ['solve'],
      transferable : ['skill', 'skills', 'present', 'work', 'presentation'],
    };

      str = $('.question').val();

      finalIndex = '';



      Object.keys(keywords).forEach(function(ele, index) {

        keywords[ele].forEach(function(innerele, innerindex) {
           if (str.toLowerCase().indexOf(innerele) >= 0)
            {
              //finalIndex = ele;
              $('.ilos').val(ele);
            }
        });


      });



  });

</script>
@endpush
