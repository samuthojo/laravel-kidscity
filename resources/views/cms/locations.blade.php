@extends('cms.layouts.cms')

@section('more')
@include('cms.header')
<link rel="stylesheet" href="{{asset('js/cms_Delivery Locations.js')}}">
@endsection

@section('content')
@include('cms.modals.edit_category_modal')
@include('cms.modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'Delete this category and its products!',
  'action' => 'Confirm',
  'function' => 'deleteCategory()',])

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif
@include('cms.alerts.success-alert')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold; color: #337ab7;"class="panel-title pull-left">
      Delivery Locations: </h3>
     <span onclick="showModal('add_category_modal')" class="pull-right"
      title="add category">
       <i class="fa fa-plus-circle fa-2x text-primary" style="cursor: pointer;"></i>
     </span>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div id="LocationsTable" class="table-responsive">
    <table id="myTable" class="table table-hover">
      <thead>
        <th>No.</th>
        <th>Name</th>
        <th>DeliveryPrice</th>
        <th>Action</th>
      </thead>
      <tbody>
        @foreach($locations as $location)
        <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
          <td>{{$loop->iteration}}</td>
          <td>{{$location->location}}</td>
          <td>{{number_format($location->delivery_price)}}</td>
          <td>
            <div class="btn-group">
              <button class="btn btn-warning"
                onclick="showEditLocationModal()"
                  title="edit location">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
              <button class="btn btn-danger" title="delete location"
                onclick="showDeleteConfirmationModal()">
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
              title: "Delivery Locations",
              messageTop: "The List Of Delivery Delivery Locations As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'excel',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Delivery Locations",
               messageTop: "The List Of Delivery Delivery Locations As Of {{date('d-m-Y')}}"
            },
             {
               extend: 'pdf',
               exportOptions: {
                 columns: ":not(:last-child)"
               },
               title: "Delivery Locations",
               messageTop: "The List Of Delivery Delivery Locations As Of {{date('d-m-Y')}}"
            }
        ],
        iDisplayLength: 8,
        bLengthChange: false
    });
  });
</script>
@endsection
