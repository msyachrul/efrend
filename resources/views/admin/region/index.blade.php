@extends('layout.layouts')

@section('title','Regions Management')

@section('extraStyleSheet')
	<link rel="stylesheet" href="{{ asset('assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
@endsection

@section('breadcrumb','Regions Management')

@section('breadcrumbList')
	<li><a href="#">Manage Menu</a></li>
	<li class="active">Regions Management</li>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                            	<strong style="font-size:24px">List of Regions</strong>
                            	<a class="btn btn-secondary rounded pull-right" href="{{ route('region.create') }}"><i class="fa fa-plus"></i> Create New</a>	
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                              <table id="table-region" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th width="1%">No</th>
                                    <th>Region Name</th>
                                    <th width="10%">Action</th>
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
                                        <td class="btn-group">
                                            <a class="btn btn-secondary btn-sm rounded" href="{{ route('region.show',$value->id) }}">Detail</a>
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
          $('#table-region').DataTable(
            {
                pageLength: 10,
                bLengthChange: false,
            });
        } );
    </script>
@endsection