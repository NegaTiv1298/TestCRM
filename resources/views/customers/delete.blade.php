@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Delete Customer</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Delete Customer Page</li>
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
            <div class="container-fluid">
                <form method="post" action="{{ route('delete_customer') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Are you sure you want to delete this client?</label>
                    </div>
                    <button type="submit" name="delete" value="{{ $id }}" class="btn btn-danger">Delete</button>
                    <button type="submit" name="back" class="btn btn-success">Back</button>
                </form>
            </div>
        </div>
    </div>
@endsection
