@extends('layout.layouts')

@section('title','Regions Management')

@section('breadcrumb','Regions Management')

@section('breadcrumbList')
    <li><a href="#">Manage Menu</a></li>
    <li><a href="{{ route('region.index') }}">Regions Management</a></li>
    <li class="active">Create New</li>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <span style="font-size:24px">Create New Region</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('region.store')}}" method="post" style="max-width:70%;margin:auto">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name"><b>Name</b></label>
                                    <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" autocomplete="off" autofocus="on" placeholder="Region Name">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary form-control">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
