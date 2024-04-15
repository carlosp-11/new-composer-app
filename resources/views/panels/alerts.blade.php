@if (session('success'))
    <div class="alert alert-success c px-0 mx-0 alert-dismissible fade show z-3 position-absolute w-100 animated fadeInLeft" 
        role="alert" id="miAlerta"
    >
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger mt-3 px-0 mx-0 alert-dismissible fade show z-3 position-absolute w-100 animated fadeInLeft" 
        role="alert" id="miAlerta"
    >
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach 
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
  <div class="alert alert-danger  mt-3 px-0 mx-0 alert-dismissible fade show z-3 position-absolute w-100 animated fadeInLeft" 
    role="alert" id="miAlerta"
  >
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
