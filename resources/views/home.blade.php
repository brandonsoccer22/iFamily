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
                    @if (session('status')=="logged_in")
                        <div class="alert alert-success" role="alert">
                            You are logged in!
                        </div>                        
                    @endif                                      
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    @if(isset($user))
    console.log({!! $user !!});
    @endif
</script>

@endsection
