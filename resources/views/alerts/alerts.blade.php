<div class="col-md-12">
   @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!!Session('success')!!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
    @endif
</div>
<div class="col-md-12">
   @if(session('delete'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {!!Session('delete')!!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
    @endif
</div>
<div class="col-md-12">
   @if(session('edit'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {!!Session('edit')!!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
    @endif
</div>
