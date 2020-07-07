@extends('layouts.login')

@section('content')
  <style media="screen">
  .login-content {
  max-width: 540px;
  margin: 8vh auto;
  margin-top: 2vh;
  margin-right: auto;
  margin-bottom: 8vh;
  margin-left: auto;

  .login-form {
    background: #ffffff;
    padding: 30px 30px 20px;
    padding-top: 10px;
    padding-right: 30px;
    padding-bottom: 20px;
    padding-left: 30px;
    border-radius: 2px;
}
}
  </style>

  <div class="">
        <div class="container ">
          <div class="row">
                <div class="col-md-6 offset-md-3 text-center">
                    <div class="card">
                    <div class="card-body">
                           <div class="text-center">
                              <img class="align-content" height="400" width="400" src="images/plataforma3.png" alt="">
                           </div>
                          <form method="POST" action="{{ route('login') }}">
                              @csrf

                                 <div class="form-group">
                                      <label>Correo electronico</label>
                                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>

                                  <div class="form-group">
                                      <label>Contraseña</label>
                                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                      @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>

                                  <div class="form-group">
                                      <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                          <label class="form-check-label" for="remember">
                                              {{ __('Recordarme') }}
                                          </label>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                  <div class="col-md-12 offset-md-12">
                                      <button type="submit" class="btn btn-primary">
                                          {{ __('Login') }}
                                      </button>

                                  </div>
                              </div>
                             <!-- <div class="register-link m-t-15 text-center">
                                  <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                              </div>-->
                          </form>
                  </div>
                  </div>
            </div>


            
          </div>
       </div>
  </div>

@endsection
