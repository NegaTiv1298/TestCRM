@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Customers Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Customers Page</li>
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
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Customer's name</th>
                        <th scope="col">Edit Customer</th>
                        <th scope="col">Delete Customer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <th scope="row">{{ $customer->id }}</th>
                            <td colspan="1">{{ $customer->name }}</td>
                            <td colspan="1"><a href="edit/customer/{{ $customer->id }}" target="_blank">Edit</a></td>
                            <td colspan="1"><a href="delete/customer/{{ $customer->id }}" class="link-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
