<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    </head>
    <body class="">
       <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Navbar</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                  <a class="nav-link" href="#">Features</a>
                  <a class="nav-link" href="#">Pricing</a>
                  <a class="nav-link disabled">Disabled</a>
                </div>
              </div>
            </div>
          </nav>
       </header>
       <div  class="d-flex flex-column align-items-center mt-5 ml-3 ">
        <h1>Share your files</h1>
            <div class=" card col-md-5 col-10 form-card shadow ">

                <div class="card-body">
                    <div class="text-right">
                    <form id="store_form" action="{{route('upload')}}" enctype="multipart/form-data" method="post">
                
                        @csrf

                        <div class="form-floating mb-2">
                            <input type="file" class="form-control" name="shared_files[]" id="file" multiple>
                            <label for="file">Upload File</label>
                          </div>
                       
                       <div class="col-md">

                          <div class="form-floating mb-2">
                            <input type="email"  name="recipient_email" placeholder="Email to" class="form-control" id="recipientEmail">
                            <label for="recipientEmail">Email To</label>
                          </div>
                       </div>

                       <div class="col-md">

                          <div class="form-floating mb-2">
                            <input type="email"  name="sender_email" placeholder="your email" class="form-control" id="senderEmail">
                            <label for="senderEmail">Your Email</label>
                          </div>
                       </div>
                       <div class="col-md">

                          <div class="form-floating mb-2">
                            <input type="text" name="title" placeholder="title" class="form-control" id="title">
                            <label for="title">Title </label>
                          </div>
                       </div>
                       <div class="col-md">

                          <div class="form-floating mb-2">
                            <input type="text" name="message" placeholder="message" class="form-control" id="Message">
                            <label for="Message">Message </label>
                          </div>
                       </div>

                       <div class="col-md">

                        <div class="form-floating mb-2">
                          <select name="" id="">
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                          </select>
                          <label for="Message">Message </label>
                        </div>
                     </div>
                          <div class="form-group center">
                            <button style="text-align: center" type="submit" class="btn btn-primary">Upload  </button>
                          </div>
                      </form>

                    </div>
    
                </div>
              </div>
    </div>
    <script src="{{asset('assets/js/main.js')}}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>
