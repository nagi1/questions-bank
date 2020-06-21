@extends('layouts.app')


@section('content')

   @include('flash::message')

<form action="{{ route('generate.store') }}" method="post">

    {{ csrf_field() }}


    <input type="hidden" name="template" value="{{ $_GET['template'] }}">

{!! Form::hidden('query_string', $_SERVER["QUERY_STRING"]) !!}
{!! Form::hidden('subject_id', $_GET['subject']) !!}

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
                <p style="font-size:20px">

                        {!! Form::select('exam_type', ['midterm' => 'Midterm', 'final' => 'Final'], null ) !!}


                    Exam for
                    <select name="exam_term">
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="summer course">summer course</option>
                    </select> Term,
                    Academic year
                    <select name="exam_year">
                        <option value="2018/2019">2018/2019</option>
                        <option value="2019/2020">2019/2020</option>
                        <option value="2020/202">2020/2021</option>
                        <option value="2021/2022">2021/2022</option>
                        <option value="2022/2023">2022/2023</option>
                    </select>
                </p>
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
                        Examination Date : <input name="exam_date" type="date">
                    </p>
                    <p>
                        Examination Starts:
                        <select name="exam_daytime">
                            <option value="Morning">Morning</option>
                            <option value="Evening">Evening</option>
                        </select>
                    </p>
                    <p>
                        Allowed Examination Time:
                        <select name="exam_duration">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select> hour
                    </p>
                    <p>
                        Total Marks: <input id="total_marks" name="total_marks" type="text"> Marks
                    </p>
                </div>
             </div>
            </div>
            <div style="width:98%; margin: 10px auto; overflow: hidden; text-align: center; border: 5px solid #000;">
                <p style="font-size:18px; font-weight: bold; padding:5px;">
                    The Examination consist of
                    (x)
                        Questions in
                    (x)
                    page
                </p>
            </div>
            <div style=" padding-left: 10px">
                    <div>
                        <p style="font-size:20px;">Instructions of Examination (<input style="width: 50%" type="text" name="header_instructions" value="Read following Questions Carefully answer all of them, assume any messing data">)</p>
                    </div>
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
                                <input id="question_marks" type="text" name="question_marks[{{ $i }}]" style="width:40px; ">.... Marks
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
            <button type="submit" id="submit" class="btn btn-primary" >Generate Exam</button>
        </div>

    </form>
@endsection



