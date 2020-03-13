@if(session('success') || isset($successMsg))
<div class="alert alert-success mt-2 mb-2 alert-dismissible showalert ">
    {{ session('success') }}
    @if(isset($successMsg))
    {{ $successMsg }}
    @endif
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


@if(session('error') || isset($error))
<div class="alert alert-danger mt-2 mb-2 alert-dismissible showalert ">
    {{ session('error') }}
    @if(isset($error))
    {{ $error }}
    @endif
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif