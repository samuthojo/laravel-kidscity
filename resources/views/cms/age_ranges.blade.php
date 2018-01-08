@extends('cms.layouts.cms')

@section('more')
@include('cms.header')
<script src="{{asset('js/cms_age_ranges.js')}}"></script>
@endsection

@section('content')
@include('cms.modals.add_age-range_modal')
@include('cms.modals.edit_age-range_modal')
@include('cms.modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'Delete this age-range!',
  'action' => 'Confirm',
  'function' => 'deleteAgeRange()',])

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif
@include('cms.alerts.success-alert')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold; color: #337ab7;"class="panel-title pull-left">
      Age Ranges: </h3>
     <span onclick="showModal('add_age_range_modal')" class="pull-right"
      title="add age-range">
       <i class="fa fa-plus-circle fa-2x text-primary" style="cursor: pointer;"></i>
     </span>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div id="ageRangesTable" class="table-responsive">
    <table id="myTable" class="table table-hover">
      <thead>
        <th>No.</th>
        <th>Range (yrs)</th>
        <th>Action</th>
      </thead>
      <tbody>
        @foreach($ageRanges as $ageRange)
        <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
          <td>{{$loop->iteration}}</td>
          <td>{{$ageRange->range}}</td>
          <td>
            <div class="btn-group">
              <a class="btn btn-default" title="view products"
               href="{{ route('age_ranges.products', ['ageRange' => $ageRange->id]) }}">
                <span class="glyphicon glyphicon-eye-open"></span>
              </a>
              <button class="btn btn-warning" title="edit age-range"
                onclick="showEditAgeRangeModal({{$ageRange}})">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
              <button class="btn btn-danger" title="delete age-range"
                onclick="showDeleteConfirmationModal({{$ageRange}})">
                <span class="glyphicon glyphicon-trash"></span>
              </button>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
<script>
  $(document).ready(function () {
    $("#myTable").dataTable({
        dom: 'Bfrtip',
        buttons: [
            {
              extend: 'print',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: "Age Ranges",
              messageTop: "The List Of Age Ranges As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'excel',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Age Ranges",
               messageTop: "The List Of Age Ranges As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'pdf',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Age Ranges",
               messageTop: "The List Of Age Ranges As Of {{date('d-m-Y')}}"
            }
        ],
        iDisplayLength: 8,
        bLengthChange: false
    });
  });
</script>
@endsection
