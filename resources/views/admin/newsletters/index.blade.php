@extends('admin.default')

@section('css')

<style type="text/css">
    .widget-tasks-item input[type=checkbox]:checked~.widget-tasks-title {
        color: #a1a7ab;
        text-decoration: none !important;
    }
</style>

@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="px-content">
        <div class="page-header">
            <h1>
                <a href="javascript:void(0)">
                    <span class="text-muted font-weight-light">
                        <i class="fa fa-calendar-minus-o"></i>&nbsp;Newsletters
                    </span>
                </a>
            </h1>
        </div>
        <div class="panel">
            <div class="panel-body">
                @include('flash::message')
                <form>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label class="control-label">Message</label>
                            <textarea id="message" name="message" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-sm-12">
                            <span id="loader">
                                <i class="fa fa-spinner fa-2x fa-spin pull-right"></i>
                            </span>
                            <button type="button" id="send" class="btn btn-primary pull-right"><i class="fa fa-paper-plane-o"></i>&nbsp;Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="panel panel-list">
            <li class="list-group-item">
                <label class="custom-control custom-checkbox">
                    <input type="checkbox" id="select-all" class="custom-control-input">
                    <span class="custom-control-indicator"></span>
                    <span class="widget-tasks-title">&nbsp;Select All</span>
                </label>
            </li>
            @if(isset($users))
                @foreach($users as $user)
                <div class="widget-tasks-item">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" data-user-id="{{ $user->id }}" class="custom-control-input selected-user">
                        <span class="custom-control-indicator"></span>
                        <span class="widget-tasks-title">&nbsp;{{ $user->name }}</span>
                    </label>
                </div>
                @endforeach
            @endif
        </div>

    </div>
@endsection


@section('js')

<script type="text/javascript">

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#loader').css("visibility", "hidden");

    $('#select-all').on('click', function(e){
        $this = this;  
        $.each($(this).parents('div.panel-list').find('.widget-tasks-item>label>input'), function(i, item){
          $(item).prop('checked', $this.checked);
        });
    });

    $('#send').on('click',function(){

        var selected_user = [];

        $('.selected-user').each(function(index,element){

            if($(element).is(':checked'))
            {
                selected_user.push($(element).data('user-id'));
            }

        });

        var message = $('#message').val();
        var users_id = Object.assign({}, selected_user);

        var jsObj = {
            'users_id' : users_id,
            'message'  : message
        };

        $.ajax({
            url: "{{ route('admin.newsletter.send') }}",
            type: "POST",
            dataType: "json",
            data: jsObj,
            beforeSend: function(){
                $('#send').prop('disabled', true);
                $('#loader').css("visibility", "visible");
            }
        }).done(function(response){
            $('#loader').css("visibility", "hidden");
            $('#send').prop('disabled', false);
            $('#message').summernote('reset');
            $('.selected-user').each(function(index,element){
                if($(element).is(':checked'))
                {
                    $(element).prop('checked', false);
                }
            });
            if($('#select-all').is(':checked'))
            {
                $('#select-all').prop('checked', false);
            }
            alert(response.message);
        });

    });
    
    // Initialize Summernote
    $(function() {
      $('#message').summernote({
        height: 200,
        placeholder: 'Type description here..',
        toolbar: [
          ['parastyle', ['style']],
          ['fontstyle', ['fontname', 'fontsize']],
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['insert', ['picture', 'link', 'table', 'hr']],
          ['history', ['undo', 'redo']],
          ['misc', ['codeview', 'fullscreen']],
          ['help', ['help']]
        ],
        disableResizeEditor: true
      });
    });

</script>

@endsection


