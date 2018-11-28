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
                            <textarea id="message" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-sm-12">
                            <button class="btn btn-primary pull-right"><i class="fa fa-paper-plane-o"></i>&nbsp;Send</button>
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
                        <input type="checkbox" class="custom-control-input">
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

    $('#select-all').on('click', function(e){
        $this = this;  
        $.each($(this).parents('div.panel-list').find('.widget-tasks-item>label>input'), function(i, item){
          $(item).prop('checked', $this.checked);
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


