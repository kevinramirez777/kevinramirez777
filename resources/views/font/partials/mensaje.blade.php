@if(Session::has('success'))
      <div class="alert alert-success" role="alert">
          {{Session::get('success')}}
      </div>
    @elseif(Session::has('warning'))
      <div class="alert alert-danger" role="alert">
          {{Session::get('warning')}}
      </div>
    @endif