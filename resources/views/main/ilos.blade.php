@extends('layouts.app')

@section('content')

    <section class="content container-fluid" style="background:#d5e2f3">
      <div>
        <div class="box box-primary">
          <!-- /.box-header -->
          <!-- form start -->
            <h2 class="content-header" style="text-align:center">
                Help Me Detrmine Question ILOs Type!
            </h2>
          <div>
            <form role="form" style="width:90%; margin:auto; overflow:hidden">
                <!--normal Questions-->
                <div class="box-body Question">
                    <div class="add-questions">
                        <div class="form-group">
                            <span class="list"></span><label for="Question name"> Question Title</label>
                            <input type="text" class="title form-control" id="Question name" placeholder="Enter Question Title">
                        </div>

                        <div style=" width:95%; margin: auto; display: flex; flex-direction: row;">

                            <div class="form-group " style="width:70%;">
                                <label for="exampleInputFile">ILOs Standrad</label>
                                <select class="ilos form-control" style="font-size: 20px; height: 100%;">
                                    <option value="">Type in the Question to detrmine or choose</option>
                                    <option value="knowledge">Knowledge and understanding</option>
                                    <option value="intellectual">Intellectual skills</option>
                                    <option value="practical">Professional and practical skills</option>
                                    <option value="transferable">General and transferable skills</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin:5px 88%">

                </div>
                <div style="width:90%; height:2px; background:#000; margin:auto; overflow:hidden"></div>


                    </div>
                </div>
            </form>
          </div>
        </div>
        <!-- /.box -->
      </div>
    </section>


@endsection

@push('scripts')
    <script type="text/javascript">

  $('.title').on('change', function() {

    keywords =
    {
      knowledge : ['define', 'mention', 'list', 'describe', 'what is', 'where are', 'what are',],
      intellectual : ['explain', 'express', 'stablish', 'analyze', 'draw', 'state'],
      practical : ['solve'],
      transferable : ['skill', 'skills', 'present', 'work', 'presentation'],
    };

      str = $('.title').val();

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
