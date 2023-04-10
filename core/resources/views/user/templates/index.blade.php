@extends('layouts.app')
@section('title','Use Case Templates')
@section('breadcrumb')
    <li class="breadcrumb-item active"> Use Case Templates</li>
@endsection
@section('content')
<div class="main-content p-2 p-md-4 pt-0">
    <div class="row">

        <div class="col-md-12">
            <div class="my-projects all-templates">
                <div class="my-projects-header border-bottom">
                    <h5 class="header-title text-capitalize"> Use Case Templates </h5>
                </div>
                <div class="my-projects-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="category-list">
                                <li class="category-list-item {{ (Route::currentRouteName() == 'user.templates' && !request()->input('cat')) ? 'active' : '' }}">
                                    <a href="{{ route('user.templates') }}" class="category-list-link">All</a>
                                </li>
                                @foreach ($categories as $cat)
                                    <li class="category-list-item {{ Request::url() == route('user.templates') && request()->input('cat')==$cat->slug ? 'active' : '' }}">
                                        <a href="{{ route('user.templates')."?cat=$cat->slug" }}"
                                            class="category-list-link ">{{ $cat->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @foreach ($allData as $case)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                            <a href="{{ route('content.create') }}?case={{ $case->id }}" class="template-card">
                                <figure class="card-img">
                                    <img src="{{ filePath($case->icon) }}" alt="{{ $case->title }}">
                                </figure>
                                <h3 class="card-title"> {{ $case->title }} </h3>
                                <p class="card-des">{{ $case->details }}</p>
                            </a>
                        </div>
                    @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection