@extends('layout.layouts')

@section('title','Assets')

@section('extraStyleSheet')
    <link rel="stylesheet" href="{{ asset('assets/css/lib/select2/select2.min.css') }}">
@endsection

@section('breadcrumb','Assets')

@section('breadcrumbList')
    <li><a href="#">Data Reports</a></li>
    <li><a href="{{ route('asset.userIndex') }}">Assets</a></li>
    <li class="active">Detail</li>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <span style="font-size:24px">Asset Detail</span>                
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="update-form" style="max-width:70%;margin:auto">
                                <div class="form-group">
                                    <label for="name"><b>Name</b></label>
                                    <input type="text" class="form-control" value="{{ $value->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="address"><b>Address</b></label>
                                    <textarea class="form-control" style="height:200px;resize:none" readonly>{{ $value->address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description"><b>Description</b></label>
                                    <textarea class="form-control" style="height:200px;resize:none"readonly>{{ $value->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category"><b>Category</b></label>
                                    <select class="form-control categorySelect" disabled>
                                        <option value=""></option>
                                        @foreach($category as $key => $v)
                                            @if($v->id == $value->category_id)
                                            <option value="{{ $v->id }}" hidden selected>&nbsp{{ $v->id." - ".$v->name }}</option>
                                            @else
                                            <option value="{{ $v->id }}">&nbsp{{ $v->id." - ".$v->name }}     
                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="region"><b>Region</b></label>
                                    <select class="form-control regionSelect" disabled>
                                        <option value=""></option>
                                        @foreach($region as $key => $v)
                                            @if($v->id == $value->region_id)
                                                <option value="{{ $v->id }}" hidden selected>&nbsp{{ $v->id." - ".$v->name }}</option>
                                            @else
                                                <option value="{{ $v->id }}">&nbsp{{ $v->id." - ".$v->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picture"><b>Picture</b></label>
                                    <div class="form-control">
                                    @foreach($picts as $key => $v)
                                        <a href="{{ asset(Storage::url($v->path)) }}"><img src="{{ asset(Storage::url($v->path)) }}" width="200px"></a>
                                    @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="50%">Certificate</th>
                                                <th>Number</th>
                                                <th width="20%">Attachment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($integration as $key => $v)
                                            <tr>
                                                <td>{{ $v->name }}</td>
                                                <td>{{ $v->number }}</td>
                                                <td class="text-center"><button type="button" class="btn btn-link btn-show" style="color:grey" data-id="{{ $v->id }}">Show</button></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
<!--                                 <div class="form-group">
                                    <label><b>Last Updated By</b></label>
                                    <input type="text" class="form-control" value="{{ $value->user }}" disabled>
                                </div> -->
                                <div class="form-group btn-process">
                                    <a href="{{ route('asset.userIndex') }}" class="btn btn-secondary form-control">Close</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="attachmentModal" tabindex="-1" role="dialog" aria-labelledby="attachmentModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="attachmentModalTittle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicator -->
                        <ol class="carousel-indicators">
                        </ol>
                          <!-- Wrapper for slides -->
                        <div class="carousel-inner">                            
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control-prev" href="#imageCarousel" data-slide="prev">
                            <span class="fa fa-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control-next" href="#imageCarousel" data-slide="next">
                            <span class="fa fa-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extraScript')
    <script src="{{ asset('assets/js/lib/select2/select2.min.js') }}"></script>

    <script type="text/javascript">
        ( function ($) {
            $(document).ready(function() {
                $('.categorySelect').select2();
                $('.regionSelect').select2();
            });

            $(document).on('click','.btn-show',function () {
                $('#attachmentModal').modal('show');
                let req = {
                    '_token': '{{ csrf_token() }}',
                    'coa_id': $(this).data('id'),
                };
                $.ajax({
                    url: "{{ route('asset.integrationAttachment') }}",
                    type: "post",
                    data: req,
                    success: function(response) {
                        let carousel = "";
                        let html = "";
                        for (var i = 0; i < response.length; i++) {

                            carousel += "<li data-target='#imageCarousel' data-slide-to='"+i+"'></li>"

                            html += "<div class='carousel-item'>";
                            html += "<img src='.."+response[i].link+"'/>";
                            html += "</div>";
                        }
                        $('.carousel-indicators').html(carousel);
                        $('.carousel-inner').html(html);
                        $('.carousel-indicators').addClass('active');
                        $('.carousel-item:first').addClass('active');
                    }
                });
            });
        })(jQuery);

    </script>
@endsection