@extends('layouts.app')

@section('content')

<section class="content container-fluid">
    <div>
        <div class="box box-primary">
            <div class="containar">
                <button class="b btn btn-primary">Generate New {{ ucfirst($type) }}</button>
                <div class="desc">


                    <div class="box box-primary">
                        <form method="get" action="{{ route('generate') }}">
                            {!! Form::hidden('type', $type) !!}

                            {{ csrf_field() }}

                            <div style=" padding-top:10px; width: 100%;">
                                <div class="form-group" style="width: 40%;  margin: auto; overflow: hidden;">
                                    <label style="font-size:20px;">Choose Subject</label>
                                    <select name="subject" class="form-control">
                                        <?php $subjects = App\Models\Subject::get();  ?>
                                        @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->title }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group" style="width: 40%;  margin: auto; overflow: hidden;">
                                    <label style="font-size:20px;">Number of Questions</label>
                                    <select name="noq" class="form-control">


                                        @for ($i = 1; $i < 9; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor


                                    </select>
                                </div>

                                <div class="form-group" style="width: 40%;  margin: auto; overflow: hidden;">
                                    <label style="font-size:20px;">Choose Template</label>
                                    <select name="template" class="form-control">

                                        @foreach (\Illuminate\Support\Facades\File::files(public_path() .
                                        '\templates\exam') as $file)
                                        <option value="{{ $file->getFileName() }}">{{ $file->getFileName() }}</option>
                                        @endforeach

                                    </select>
                                </div>




                            </div>
                            <div style="padding: 30px 20px;margin:0 85%">
                                <button type="submit" class="btn btn-primary">Continue</button>
                            </div>
                        </form>

                    </div>



                </div>




            </div>




        </div>
    </div>
    </div>
</section>


@endsection
