@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Topic
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($topic, ['route' => ['topics.update', $topic->id], 'method' => 'patch']) !!}

                        @include('topics.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection