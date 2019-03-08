@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Roles</h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Roles</li>
        </ol>
        
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Roles List</h3>
                        <div class="form-group pull-right">
                            <a href="{{ route('rolescreate') }}" class="btn btn-sm btn-primary">Create</a>
                        </div>
                    </div>
                    <div class="box-body">
                    <div class="flash-message">
							@foreach (['danger', 'warning', 'success', 'info'] as $msg)
							  @if(Session::has('alert-' . $msg))

							  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
							  @endif
							@endforeach
                          </div> 
                        <form id="frm-example" method="POST">
                        {{ csrf_field() }}
                        <table class="table table-bordered" id="role-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>IsEnabled</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                        <button class="btn btn-danger btn-sm">Delete Checked</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    var t = $('#role-table').DataTable({
        processing: true,
        serverSide: true,
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 1
        } ],
        "order": [[ 1, 'asc' ]],
        ajax: '{{ route('rolesdata') }}',
        columns: [
            {data: 'checkbox', name: 'checkbox',searchable: true, sortable : false},
            {data: 'id', name: 'id'},
            {data: 'role_name', name: 'role_name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
        ]
    });
    t.on('order.dt search.dt', function () {
        t.column(1, {search:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();

    $('#example-select-all').click(function (e){
      var rows = $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   $('#frm-example').on('submit', function(e){
      var form = this;
      var $button = $(this);
    
      // Iterate over all checkboxes in the table
      $(this).closest('table').find('td input:checkbox').prop('checked', this.checked).each(function(){
         // If checkbox doesn't exist in DOM
         if(!$.contains(document, this)){
            // If checkbox is checked
            if(this.checked){
               // Create a hidden element 
               $(form).append(
                  $('<input>')
                     .attr('type', 'hidden')
                     .attr('name', this.name)
                     .val(this.value)
               );
            }
         } 
      });

      $('#example-console').text($(form).serialize()); 
      e.preventDefault();
      var formData = $('#frm-example').serialize();
      $.ajax({
        url: '{{ route("rolesdelete2") }}',
        data: formData,
        type: 'post',
        dataType: 'json',
        success: function(data) {
          $('#role-table').DataTable().ajax.reload()
          //$('div.flash-message').html(data);
        }
    });
});
});
</script>
@endpush
