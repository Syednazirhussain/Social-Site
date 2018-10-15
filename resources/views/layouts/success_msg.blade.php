<!-- <div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <h4 class="alert-heading">{{ session()->get('msg.success') }}</h4>
</div> -->
<div class="alert alert-success alert-dismissable" style="text-align: center;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <h4 class="m-t-0 m-b-0"><strong><i class="fa fa-check-circle fa-lg"></i>&nbsp;&nbsp;{{ session()->get('msg.success') }}</strong></h4>
      </div>