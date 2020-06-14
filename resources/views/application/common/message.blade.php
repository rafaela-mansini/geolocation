@if (session('message'))
    <div class="alert {{ session('success') == true ? 'alert-success' : 'alert-danger' }}">
        {{ session('message') }}
    </div>
@endif