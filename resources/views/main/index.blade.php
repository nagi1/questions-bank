@extends('layouts.app')

@section('content')



    <section class="content container-fluid" >
      <div>
        <div class="box-header">
          <h2>Welcome, What you want to do?</h2>
        </div>


        <div class="box">
          <div class="containar">
            <a href="{{ route('generator', ['type'=>'final']) }}" class="b btn btn-primary">Generate Final Exam</a>
          </div>
        </div>


        <div class="box">
          <div class="containar">
            <a href="{{ route('generator', ['type'=>'midterm']) }}" class="b btn btn-primary">Generate Mid-Term Exam</a>
          </div>
        </div>


        <div class="box">
          <div class="containar">
            <a href="{{ route('generator', ['type'=>'quiz']) }}" class="b btn btn-primary">Generate Quiz</a>
          </div>
        </div>


        <div class="box">
          <div class="containar">
            <a href="{{ route('generator', ['type'=>'assignment']) }}" class="b btn btn-primary">Generate Assignment</a>
          </div>
        </div>



      </div>
    </section>


@endsection
