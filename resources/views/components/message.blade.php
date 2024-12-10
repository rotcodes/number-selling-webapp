<!-- Success Alert -->
@if(Session::has('success'))
<div class="alert bg-light-success" role="alert">
    <h3 class="alert-heading pb-2 txt-success">Successfull!</h3>
    <p>{{ (Session::get('success')) }}</p>
</div>
@endif

<!-- Error Alert -->
@if(Session::has('error'))
<div class="alert bg-light-danger" role="alert">
    <h3 class="alert-heading pb-2 txt-danger">Error!</h3>
    <p>{{ (Session::get('error')) }}</p>
</div>
@endif

<!-- Warning Alert -->
@if (session('warning'))
<div class="alert bg-light-warning" role="alert">
    <h3 class="alert-heading pb-2 txt-warning">Warning!</h3>
    <p>{{ session('warning') }}</p>
</div>
@endif

<!-- Info Alert -->
@if (session('info'))
<div class="alert bg-light-info" role="alert">
    <h3 class="alert-heading pb-2 txt-info">Info!</h3>
    <p>{{ session('info') }}</p>
</div>
@endif
