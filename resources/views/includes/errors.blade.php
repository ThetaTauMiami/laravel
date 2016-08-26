@if (count($errors) > 0)
<script>

  $(document).ready(function(){
    bootbox.alert("{{ foreach($errors as $error) $error endforeach}}");
  });

</script>
@endif
