@if($failures)
<div class="alert alert-danger" role="alert">
   <strong>Errors:</strong>

   <ul>
      @foreach ($failures as $failure)
      @foreach ($failure->errors() as $error)
      <li>Row Number : {{ $failure->row()}} {{ $error }}</li>
      @endforeach
<br>
      @endforeach
   </ul>
</div>
@endif