@extends('layouts.default')

@section('content')
	<div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
			<h1>List of PNMs</h1>
  </div>

    <div class="container">
     	<div class="row">
    		<div class="col-xs-12 text-center">
					<br/>
					{{$list = ""}}
					@foreach ($pnms as $pnm)
						<div hidden>{{$list = $list.$pnm->email.", "}}</div>
					@endforeach
					<label for="website">Emails:</label>
					<input type="text" id="website" value = "{{ $list }}" />
					<button data-copytarget="#website">Copy</button>

					<div class="panel panel-default">
    			@foreach ($pnms as $pnm)
            <h1> {{ $pnm->first_name }} {{ $pnm->last_name }} </h1>
            <p>    {{ $pnm->email }} </p>
          @endforeach
					</div>


          <script>
          /*
              Copy text from any appropriate field to the clipboard
            By Craig Buckler, @craigbuckler
            use it, abuse it, do whatever you like with it!
          */
          (function() {

              'use strict';

            // click events
            document.body.addEventListener('click', copy, true);

              // event handler
              function copy(e) {

              // find target element
              var
                t = e.target,
                c = t.dataset.copytarget,
                inp = (c ? document.querySelector(c) : null);

              // is element selectable?
              if (inp && inp.select) {

                // select text
                inp.select();

                try {
                  // copy text
                  document.execCommand('copy');
                  inp.blur();

                  // copied animation
                  t.classList.add('copied');
                  setTimeout(function() { t.classList.remove('copied'); }, 1500);
                }
                catch (err) {
                  alert('please press Ctrl/Cmd+C to copy');
                }

              }

              }

          })();
          </script>
    		</div>
  		</div>
    </div>
