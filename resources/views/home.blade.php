@extends('layouts.default-layout')

@section('maincontent')


<div class="container-fluid d-flex" style="height: 100%; width: 100%; position: relative;">

            <img src="{{ asset('images/simon-kadula--gkndM1GvSA-unsplash.jpg') }}" alt="" class="col-md-6 card-img w-50" style="height: 100vh; border-radius: .5rem;">

            <div class="card shadow w-100 h-100 mx-auto" id="loginForm">
                
                <div class="card-body d-flex flex-column align-items-center justify-content-center " style="background-color: aliceblue">

                    <img src="{{ asset('icons/product-o-svgrepo-com.svg') }}" alt="" style="height: 180px; width: 180px;">

                    <h5 class="mt-3 fw-bold">Welcome</h5>

                    <h6 class="mt-2 mb-4 fw-semibold">Let's get started, sign in</h6>

                    <form action="/login" method="POST">
                        @csrf

                        <div class="column g-3 d-flex flex-column align-items-center" style="width: 400px">

                            <div class="col-md-10">
                                <label for="loginemail" class="form-label fs-6 mb-0">Email</label>
                                <input type="email" name="loginemail" id="loginemail" class="form-control rounded-pill " placeholder="Enter email" style="border: 1px solid rgb(48, 46, 46)" required>
                            </div>

                            <div class="col-10 mt-3">
                                <label for="loginpassword" class="form-label fs-6 mb-0">password</label>
                                <input type="password" name="loginpassword" id="loginpassword" class="form-control rounded-pill" rows="3" placeholder="Enter password" style="border: 1px solid rgb(48, 46, 46)" required></input>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-center gap-2">
                            <button type="submit" class="btn btn-success col-md-10 rounded-pill">
                                Login
                            </button>
                            
                        </div>
                    </form>
                </div>
            </div>
  
        </div>


@endsection




    