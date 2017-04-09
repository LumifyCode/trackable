<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th style="width:15%;">Date</th><th>User</th><th>Field</th>
      <th>Old Value</th><th>New Value</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Date</th><th>User</th><th>Field</th>
      <th>Old Value</th><th>New Value</th>
    </tr>
  </tfoot>
  <tbody>
    @if(count($trackable->history)>0)
    @foreach($trackable->history as $history)
    @if($history->event == 'updated')
    @foreach($history->data as $data)
    <tr>
      <td>{{$history->created_at}}</td>
      <td>{{$history->causer->name}}</td>
      <td>{{$trackable->formatField($data['field'])}}</td>
      <td>{{$trackable->display($data['field'],$data['old_value'])}}</td>
      <td>{{$trackable->display($data['field'],$data['new_value'])}}</td>

    </tr>
    @endforeach
    @else
    <tr>
      <td>{{localize_datetime($history->created_at)}}</td>
      <td>{{$history->causer->name}}</td>
      <td colspan="3" class="text-center text-uppercase">
        <strong>
          Record {{ucfirst($history->event)}}
        </strong>
      </td>
    </tr>
    @endif
    @endforeach
    @endif
  </tbody>
</table>