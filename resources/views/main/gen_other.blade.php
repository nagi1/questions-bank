@extends('layouts.app')


@section('content')

 @include('flash::message')
<form action="{{ route('other.generate.store') }}" method="post">

    {{ csrf_field() }}


    <input type="hidden" name="template" value="{{ $_GET['template'] }}">

{!! Form::hidden('query_string', $_SERVER["QUERY_STRING"]) !!}
{!! Form::hidden('subject_id', $_GET['subject']) !!}
{!! Form::hidden('exam_type', $_GET['type']) !!}


     <div style="width:90%; margin:auto; overflow: hidden; background: #fff;">
        <div style="margin:20px; border: 5px solid #000; height:93%;">
            <div style="width:90%; margin: auto; overflow: hidden;">


                <h3 style="color:red;">This is only A preview form please choose the desaier Template To Generate.</h3>
                <br>
                <div class="clearfix"></div>

                <img src="{{ asset('assets/image/download.jpg') }}" alt="Image" style="width:100px; float: left;">


                <img src="{{ asset('assets/image/ss.png') }}" alt="Image" style="width:120px; float: right">

            </div>
            <div style="width:98%; margin: 10px auto; overflow: hidden; text-align: center; border: 5px solid #000;">
             <div>
                <h2>Octoper 6 University</h2>
                <p style="font-size:20px">{{$s->faculty}}</p>

             </div>
             <div style=" width:100%; margin: auto; overflow: hidden; text-align:left; border-top: 5px solid #000; display: flex; flex-direction: row; justify-content: space-around;">
                <div style="font-size:18px; font-weight: bold; padding:5px; width:45%; border-right:5px solid #000; ">
                    <p>
                        Department Of
                        <select name="department">
                            <option <?php if($s->department == 'Computer Science') echo 'selected' ?> value="Computer Science">Computer Science</option>
                            <option <?php if($s->department == 'Information Systems') echo 'selected' ?> value="Information Systems">Information Systems</option>
                            <option <?php if($s->department == 'CS & IS') echo 'selected' ?> value="CS & IS">CS & IS</option>
                        </select>
                    </p>
                    <p>
                        Study Year/Level :
                        <select name="level">
                            <option <?php if($s->level == 1) echo 'selected' ?> value="1st">1st</option>
                            <option <?php if($s->level == 2) echo 'selected' ?> value="2nd">2nd</option>
                            <option <?php if($s->level == 3) echo 'selected' ?> value="3rd">3rd</option>
                            <option <?php if($s->level == 4) echo 'selected' ?> value="4th">4th</option>
                        </select>
                        Level
                    </p>
                    <p>
                        Course Title : <input name="title" value="{{ $s->title }}" type="text">
                    </p>
                    <p>
                        Course code: <input name="code" value="{{ $s->code }}" type="text">
                    </p>
                </div>

                <div style="font-size:18px; font-weight: bold; padding:5px; width:45%; border-left:5px solid #000; ">
                    <p>
                        {{ ucfirst($_GET['type']) }} Number: # <input style="width:20%;" name="ass_num" type="text" value="{{ $_GET['ass_num'] }}">
                    </p>
                    <p>
                        Model: {{ $_GET['nom'] }} Model(s)
                        <input type="hidden" name="nom" value="{{ $_GET['nom'] }}">
                    </p>
                    @if ($_GET['type'] == 'assignment')
                    <p>
                        Due (Dead Line): <input type='text' style="width:50%;" name="due"   id='datetimepicker1' />
                    </p>

                    @else
                    <p>
                        Time: <input type='text' style="width:50%;" name="dur" /> min
                    </p>
                    @endif

                    <p>
                        Total Marks: <input name="total_marks" type="text"> Marks
                    </p>
                </div>
             </div>
            </div>

            <div style=" padding-left: 10px">


                    <div>
                        <p style="font-size:20px; font-weight: bold; padding:5px;  text-decoration: underline;">Choose Chapters to generate from: </p>
                    </div>

                    <div>
                         <div class="row">


                            @foreach ($s->topics()->get() as $topic)
                                <div style="font-size:20px; font-weight: bold; padding:5px;  text-decoration: underline;" class="col-md-3">{{ $topic->title }} - ({{ $topic->questions->count() }} Qs): <input type="checkbox" name="topics[]" value="{{ $topic->id }}"></div>
                            @endforeach




                        </div>
                    </div>

                    <div>
                        <p style="font-size:20px; font-weight: bold; padding:5px;  text-decoration: underline;">Answer the follwing questions :</p>
                    </div>


@for ($i = 1; $i <= $qc; $i++)

                <div style=" display: flex; flex-direction: column; padding:5px; ">
                    <div >
                        <h4 style="font-size:20px; font-weight: bold; text-decoration: underline; float: left;">Question {{ $i }}:</h4>
                        <input type="hidden" name="question_num[{{ $i }}]" value="{{ $i }}">
                        <p style="float:right; font-size:20px; font-weight: bold;">
                            (
                                <input type="text" name="question_marks[{{ $i }}]" style="width:40px; ">.... Marks
                            )
                        </p>
                    </div>
                    <div style="font-size:20px;">
                        <div>
                            <label for="exampleInputFile" style="font-size:20px; margin-left:30px">Question Types</label>
                            <select name="question_type[{{ $i }}]" style="width:300px; height:32px;">
                                @foreach ($question_types as $qt)
                                    <option value="{{ $qt->id }}">{{ $qt->name }}</option>
                                @endforeach
                            </select>

                            <div style="margin:20px">
                                <label for="numberquestion">Number of Questions</label>
                                <input type="text" name="question_count[{{ $i }}]" id="numberquestion">
                            </div>
                        </div>
                    </div>
                </div>

@endfor




                <div style="width:30%; margin: auto; overflow: hidden; padding: 20px 0">
                    <p style="font-size:25px; font-weight: bold; font-style: italic;">With My Best Wiches</p>
                    <p style="font-size:15px; font-weight: bold; font-style: italic;">DR.<input name="instructor_name" type="text" value="{{ auth()->user()->name }}"></p>
                </div>
            </div>
        </div>
        <div style="width:15%; margin: auto; overflow: hidden; ">
            <button type="submit" class="btn btn-primary" >Generate {{ ucfirst($_GET['type']) }}</button>
        </div>

    </form>
@endsection

@push('scripts')
           <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker(

                {
                    format: 'DD/mm/YYYY h:mm a'
                }

                    );
            });
        </script>
@endpush




