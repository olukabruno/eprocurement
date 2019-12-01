@extends('layouts.app')
@section('content')

<div class="container-fluid">
	<div class="row">
		 <div class="col-md-12">
                <!-- table -->
                        <!-- update edit edelete-->
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <b class="panel-title">Archived Purchase Requests</b>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-condensed" id="datatable">
                                <thead>
                                    <tr>
                                        <th>PR Form Number</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prDT as $pr)
                                    <tr>
                                        <td>{{$pr->pr_form_no}}</td>
                                        <td>{{$pr->purpose}}</td>
                                        <td>{{$pr->status}}</td>
                                        <td>{{Carbon\Carbon::parse($pr->created_at)->format('m-d-y')}}</td>
                                        <td>
                                            <a href='{{route("pr.closeitems", $pr->id)}}' id="items" class="btn btn-primary btn-xs" title="Items"><span class="glyphicon glyphicon-th-list"></span></a>
                                           @if($pr->status != 'Cancelled')
                                           <a href='{{route("pr.delete", $pr->id)}}' id="cancel_pr" class="btn btn-danger btn-xs" title="Cancel Form"><span class="glyphicon glyphicon-remove"></span></a>
                                           @endif
                                           @if(Auth::user()->role == 1)
                                           <a href='{{route("pr.revert", $pr->id)}}' id="reset_pr" class="btn btn-info btn-xs" title="Master Reset Purchase Request Status"><span class="glyphicon glyphicon glyphicon-repeat"></span></a>  
                                           @endif
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

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
    $('#datatable').DataTable({
       
    });
});
</script>

@endsection