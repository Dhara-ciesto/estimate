@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Home @endslot
@slot('title') Dashboard @endslot
@endcomponent
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2>Welcome</h2>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="row">
    <div class="col-xl-8">
        <div class="row">
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium"><a href="{{ route('product.index') }}">Total Products </a></p>
                                <h4 class="mb-0">{{$data['products']}}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end col -->


</div>
<!-- end row -->

{{-- @endsection --}}
@section('script')
<!-- apexcharts -->
{{-- <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}
<!-- blog dashboard init -->
{{-- <script src="{{ URL::asset('/assets/js/pages/dashboard-blog.init.js') }}"></script> --}}
@endsection

@endsection

@push('js')
<!-- Responsive Table js -->
{{-- <script src="{{ URL::asset('/assets/libs/rwd-table/rwd-table.min.js') }}"></script> --}}

<!-- Init js -->
{{-- <script src="{{ URL::asset('/assets/js/pages/table-responsive.init.js') }}"></script> --}}

<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">


<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js">
</script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('assets/js/datatable.js')}}"></script>

@endpush
