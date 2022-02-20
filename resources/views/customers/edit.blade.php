@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Customer</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Customer Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
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
            <div class="container-fluid">
                @foreach($customers as $customer)
                    <form method="post" action="{{ route('edit_customer') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Form for edit customer</label>
                            <input type="number" class="form-control" hidden name="id" value="{{ $customer->id }}">
                            <input type="text" class="form-control" name="name" value="{{ $customer->name }}">
                            <input type="text" class="form-control" name="company" value="{{ $company_name }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
