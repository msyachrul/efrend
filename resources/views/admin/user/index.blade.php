@extends('layout.layouts')

@section('title','Users Management')

@section('extraStyleSheet')
	<link rel="stylesheet" href="{{ asset('assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
@endsection

@section('breadcrumb','Users Management')

@section('breadcrumbList')
	<li><a href="#">Manage Menu</a></li>
	<li class="active">Users Management</li>
@endsection

@section('content')
	<div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                            	<strong style="font-size:24px">List of Users</strong>
                            	<a class="btn btn-secondary rounded pull-right" href="{{ route('user.create') }}"><i class="fa fa-plus"></i> Create New</a>	
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                              <table id="table-region" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th width="1%">No</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th width="5%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                	@php
                                		$i = 1;
                                	@endphp
                                	@foreach($data as $key => $value)
                                	<tr>
                                		<td>{{ $i++ }}</td>
                                		<td>{{ $value->name }}</td>
                                		<td>{{ $value->email }}</td>
                                        <td>
                                            <a class="btn btn-secondary btn-sm btn-detail rounded" href="{{ route('user.show',$value->id) }}">Detail</a>
                                		</td>
                                	</tr>
                                	@endforeach
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extraScript')
    <script src="{{ asset('assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/datatables-init.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#table-user').DataTable(
            {
                pageLength: 10,
                bLengthChange: false,
            });
        } );
    </script>
@endsection