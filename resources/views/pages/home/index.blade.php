
@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="m-0 px-0 pt-5  bg-primary" style="height: 92vh;">
    <div class="row bg-primary m-0 pt-5" >
        <div class="col text-center pt-5">
            <h1 class="fw-bolder text-light" style="font-size: 200px;"> C </h1>
        </div>
        <div class="col text-center pt-5">
            <h1 class="fw-bolder text-light" style="font-size: 200px;"> R </h1>
        </div>
        <div class="col text-center pt-5">
            <h1 class="fw-bolder text-light" style="font-size: 200px;"> U </h1>
        </div>
        <div class="col text-center pt-5">
            <h1 class="fw-bolder text-light" style="font-size: 200px;"> D </h1>
        </div>        
    </div>
    <div class="row justify-content-center bg-primary px-0 mx-0 mb-5" >
        <div class="col text-center mb-5">
            <h1 class="fw-bolder text-light" > Create </h1>
        </div>
        <div class="col text-center mb-5">
            <h1 class="fw-bolder text-light" > Read </h1>
        </div>
        <div class="col text-center mb-5">
            <h1 class="fw-bolder text-light" > Update </h1>
        </div>
        <div class="col text-center mb-5">
            <h1 class="fw-bolder text-light" > Delete </h1>
        </div>        
    </div>
    <div class="row justify-content-center bg-light px-0 mx-0 py-5 mb-5" >
        <div class="col text-center">
        <i class="fa-solid fa-circle-plus text-primary fs-1"></i>
        </div>
        <div class="col text-center">
        <i class="fa-solid fa-eye text-primary fs-1"></i>
        </div>
        <div class="col text-center">
        <i class="fa-solid fa-pen text-primary fs-1"></i>
        </div>
        <div class="col text-center">
        <i class="fa-solid fa-trash-can text-primary fs-1"></i>
        </div>        
    </div>
</div>   
@endsection