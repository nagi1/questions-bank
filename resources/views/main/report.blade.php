@extends('layouts.app')

@section('content')

    <section class="content container-fluid" >
      <div>
        <div class="box box-primary">
          <div class="containar">
            <button class="b btn btn-primary">{{ ucfirst($exam->subject->title) }} {{ $exam->type }} Exam</button>
            <a href="{{ route('exam.download', ['exam_id'=>$exam->id]) }}" class="b btn btn-success">Download Exam</a>

            <hr>

            <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">{{ ucfirst($exam->subject->title) }} {{ $exam->type }} Exam Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl>
                <dt>Subject Name</dt>
                <dd>{{ $exam->subject->title }}</dd>
                <dt>Number Of Question</dt>
                <dd>{{ $qs }} Questions</dd>

              </dl>
            </div>
            <!-- /.box-body -->
          </div>

<hr>
            <div class="desc">


             <div class="box box-primary">

            <div class="box-header with-border">
                Questions ILOs Report
            </div>
                    <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                        <th>ILOs</th>
                        <th># Questions</th>
                        <th>Rito</th>
                        </tr>

                        <tr>
                        <td>Intellectual skills</td>
                        <td>{{ $ilos['is'] }}</td>
                        <td>{{  round(($ilos['is'] / $qs ) * 100, 2) }}%</td>
                        </tr>

                        <tr>
                        <td>General and transferable skills</td>
                        <td>{{ $ilos['gt'] }}</td>
                        <td>{{  round(($ilos['gt'] / $qs ) * 100, 2) }}%</td>
                        </tr>

                        <tr>
                        <td>Professional and practical skills</td>
                        <td>{{ $ilos['pp'] }}</td>
                        <td>{{  round(($ilos['pp'] / $qs ) * 100, 2) }}%</td>
                        </tr>

                        <tr>
                        <td>Knowledge and understanding</td>
                        <td>{{ $ilos['ku'] }}</td>
                        <td>{{  round(($ilos['ku'] / $qs ) * 100, 2) }}%</td>
                        </tr>


                    </table>
                    </div>
                    <!-- /.box-body -->

             </div>



            </div>


<hr>
                        <div class="desc">


             <div class="box box-primary">

            <div class="box-header with-border">
                Questions Chapters Report
            </div>
                    <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                        <th>Chapter Name</th>
                        <th># Questions</th>
                        <th>Rito</th>
                        </tr>


                        @foreach ($topics as $topic => $count)

                        <tr>
                        <td>{{ $topic }}</td>
                        <td>{{ $count }}</td>
                        <td>{{  round(($count / $qs ) * 100, 2) }}%</td>
                        </tr>

                        @endforeach




                    </table>
                    </div>
                    <!-- /.box-body -->

             </div>



            </div>




            </div>




          </div>
        </div>
      </div>
    </section>


@endsection
