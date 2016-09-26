
                        @if (count($errors) > 0)
                        <script>

                          $(document).ready(function(){
                            bootbox.alert("{{ $errors->first() }}");
                          });

                        </script>
                        @endif