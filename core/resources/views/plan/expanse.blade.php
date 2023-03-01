@extends('layouts.app')
@section('content')
    <div class="main-content p-2 p-md-4 pt-0">
        <div class="row g-4">

            <div class="col-md-12">
                <div class="card custom">
                    <div class="card-header bg-info">
                        <h5 class="card-title no-margin color-white">Plan Purchase and  Expanses Informations</h5>
                        <div class="card-button">
                            <a href="{{ route('plan.userIndex') }}" class="btn btn-success btn-xs">
                                <i class="fa fa-add"></i>
                                See Plans
                            </a>
                        </div>
                    </div>


                    <div class="row mt-4">
                        <div class="col-md-4 ">
                            <div class="m-2">


                                <h4>Plan Information</h4>
                                <ul class="list-group mt-3">
                                    <li class="list-group-item">Name: {{ $plan->name }}</li>
                                    <li class="list-group-item">Word Count: {{ $plan->word_count }}</li>
                                    <li class="list-group-item">API Call: {{ $plan->documet_count }} </li>
                                    <li class="list-group-item">Document Save Count: {{ $plan->documet_count }}</li>
                                    <li class="list-group-item">Image Save Count: {{ $plan->image_count }}</li>
                                    <li class="list-group-item">Language: {{ $plan->lang }}</li>
                                    <li class="list-group-item">Price: {{ $plan->price }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="m-2">
                                <h4>Purchase Information</h4>
                                <ul class="list-group mt-3">
                                    <li class="list-group-item">Date: {{ $order->created_at }}</li>
                                    <li class="list-group-item">Invoice: {{ $order->invoice }}</li>
                                    <li class="list-group-item">Paid Amount: {{ $order->total }} </li>
                                    <li class="list-group-item">Payment Method: {{ $order->payment_method }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="m-2">
                                <h4>Your Service Expanses summary</h4>
                                <ul class="list-group mt-3">
                                    <li class="list-group-item">Total API Call: {{ $expanse->call_api_count }}</li>
                                    <li class="list-group-item">Rest of API Call:
                                        {{ $expanse->call_api_count - $expanse->current_api_count }}</li>
                                    <li class="list-group-item">Total Document Save Count: {{ $expanse->documet_count }}
                                    </li>
                                    <li class="list-group-item">Rest Of Documet Save Count:
                                        {{ $expanse->current_documet_count }}</li>
                                    <li class="list-group-item">Total Image Save Count: {{ $expanse->image_count }}</li>
                                    <li class="list-group-item">Rest Of Image Save Count:
                                        {{ $expanse->current_image_count }}</li>
                                    <li class="list-group-item">Activated Date: {{ $expanse->activated_at }}</li>
                                    {{-- <li class="list-group-item">Activated Date: {{ dateTimeFormat($expanse->activated_at)}}</li> --}}
                                    <li class="list-group-item">Expire Date: {{ $expanse->expire_at }}</li>
                                    {{-- <li class="list-group-item">Expire Date: {{dateTimeFormat($expanse->expire_at)}}</li> --}}
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

