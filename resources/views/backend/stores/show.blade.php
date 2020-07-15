@extends('layout.base')
@section("custom_css")
<link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="stylesheet" href="{{asset('backend/assets/css/store_list.css')}}">
@stop


@php
    $storeData = $response['storeData'];
    $transactions = $response['transactions'];
@endphp

@section('content')
   
    <!-- Start Content-->
    
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <a href="{{ route('store.edit', $storeData->_id) }}" class="btn btn-success mr-2"><i class="far mr-2 fa-edit"></i>Edit
                        Store</a>
                    <a href="/admin/store" class="btn btn-primary">Go Back</a>
                </nav>
                <h4 class="mt-2">My Store</h4>
            </div>
        </div>
        
        @if(session('data'))
        <p class="alert alert-success">{{ session('data') }}</p>
        @endif

        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body pl-3 pr-3 padup">
                        <div class="text-center">
                            
                                 <b><label for="">Store Name</label></b>
                            <h5 class="text-muted font-weight-normal mt-2 mb-0">{{ ucfirst($storeData->store_name) }}</h5>
                        </div>
                        <div class="mt-5 pt-2 border-top">
                            <h4 class="mb-3 font-size-15">Store Address</h4>
                            <p class="text-muted mb-4">{{ $storeData->shop_address }}</p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body padup">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-activity" role="tabpanel"
                                aria-labelledby="pills-activity-tab">
                                <h5 class="mt-3 font-size-24 mb-4">Store Information</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0 text-muted">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Store ID</th>
                                                <td>{{ $storeData->_id }}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Email</th>
                                                <td>{{ $storeData->email }}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">TagLine</th>
                                                <td>{{ $storeData->tagline }}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Phone Number</th>
                                                <td>{{ $storeData->phone_number }}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Total Number of Customers</th>
                                                <td>{{count( $storeData->customers )}}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Total Number of Transactions</th>
                                                <td>{{$transactions}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    {{-- <div class="card-body text-muted">
                                        <div class=" text-center">
                                            <a href="#" class="btn btn-primary">View Store Transactions</a>
                                        </div>
                                      </div> --}}
                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                
                <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="float-right btn btn-danger mt-2"><i class="fas fa-trash-alt mr-2"></i>Delete store</a>
                    <form action="{{ route('store.destroy', $storeData->_id) }}" method="POST" id="form">
                        @method('DELETE')
                        @csrf                                                
                    </form>

            </div>
        </div>
@endsection

@section("javascript")
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        // any initialisation options go here
    });
   

</script>
@stop
