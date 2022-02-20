@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Companies Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Companies Page</li>
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
                        <th scope="col">Companies name</th>
                        <th scope="col">Look at the company</th>
                        <th scope="col">Edit company</th>
                        <th scope="col">Delete company</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <th scope="row">{{ $company->id }}</th>
                            <td colspan="1">{{ $company->company_name }}</td>
                            <td colspan="1"><a href="company/{{$company->id}}" class="link-info"
                                               target="_blank">Look</a></td>
                            <td colspan="1"><a href="edit/company/{{ $company->id }}" target="_blank">Edit</a></td>
                            <td colspan="1"><a href="delete/company/{{ $company->id }}" class="link-danger"
                                >Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

