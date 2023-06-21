<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>INDEX - Keycloak PHP</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.ico">
        <script src="js/keycloak.min.js"></script>
    </head>

    <body>

        <nav class="navbar bg-dark navbar-expand-lg border-bottom border-bottom-dark" data-bs-theme="dark">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                
                <div class="nav navbar-nav" id="nav-tab" role="tablist">
                  <a class="nav-link active" type="button" href="/" >Home</a>
                  <a class="nav-link" type="button" href="/id-token" >idToken</a>
                  <a class="nav-link" type="button" href="/access-token" >Token</a>
                  <a class="nav-link" type="button" href="/refresh-token" >refreshToken</a>
                  <a class="nav-link" type="button" href="/logout" >Logout</a>
                </div>

              </div>
            </div>
        </nav>

        <br>

        <div class="container text-center">
            <div class="row justify-content-lg-center">
                <div class="col-lg-auto">
                    <h1 class="fw-bolder">Backend - Keycloak in PHP</h1>
                </div>
            </div>
        </div>

        <br>

        <div class="container text-center">
          <div class="row justify-content-lg-center">

            <div class="col-auto-8">

                  <div class="container text-start">
                            <div class="card">
                              <div class="card-header text-center">
                                {{ $title }}
                              </div>
                              <div class="card-body">
                                <blockquote class="blockquote">
                                  <p id="token-base64" class="card-text"> {{ $token }} </p>
                                  <hr>
                                      <p id="token-json" class="card-text"> 
                                        <code>{{ $json }} </code>
                                      </p>
                                </blockquote>
                          </div>
                      </div>
                  </div>
            
            </div>
          </div>
        </div>
    </body>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</html>