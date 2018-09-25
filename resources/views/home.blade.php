@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <section class="jumbotron text-center">
                    <div class="container">
                      <h1 class="jumbotron-heading">iFamily</h1>
                      <p class="lead text-muted">Let your family be united through technology</p>
                      
                    </div>
                  </section>

                <div class="card-body">
                    @if(isset($addError))
                        <div class="alert alert-danger" role="alert">
                            {!! $addError !!}
                        </div> 
                    @elseif(isset($addSuccess))
                        <div class="alert alert-success" role="alert">
                            {!! $addSuccess !!}
                        </div> 
                    @elseif(isset($addChoirSuccess))
                        <div class="alert alert-success" role="alert">
                            {!! $addChoirSuccess !!}
                        </div> 
                    @elseif(session()->has('user') && session('user')['name'])
                        <div class="alert alert-success" role="alert">
                            Welcome {!! session('user')['name'] !!}!
                        </div>                        
                    @endif                                      
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    @if(session()->has('user'))
    console.log({!! session('user') !!});
    @endif
</script>

@endsection
