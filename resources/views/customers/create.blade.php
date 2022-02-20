@extends('layouts.main')
@section('content')


    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Customer</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create Customer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">

            @if($errors->any())
                <div class="alert alert-danger">
                    {{$errors->first()}}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="post" action="{{ route('crete_customer') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Form for create customer</label>
                    <input type="text" class="form-control" name="name" placeholder="Name">
                    <input type="text" class="form-control" name="company_name" placeholder="Company name">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
