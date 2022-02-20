@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Search customers by company ID</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content">
            <div class="container-fluid">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Company ID</th>
                        <th scope="col">The Company name</th>
                        <th scope="col">Customer's name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <th scope="row">{{ $company_id }}</th>
                            <td colspan="1">{{ $company_name[0]->company_name }}</td>
                            <td colspan="3">{{ $customer->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection
