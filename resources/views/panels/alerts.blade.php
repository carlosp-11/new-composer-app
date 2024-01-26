@if (session('success'))
    <div class="alert alert-success px-0 mx-0 alert-dismissible fade show z-3 position-absolute w-100" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger px-0 mx-0 alert-dismissible fade show z-3 position-absolute w-100" role="alert">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
  <div class="alert alert-danger px-0 mx-0 alert-dismissible fade show z-3 position-absolute w-100" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
