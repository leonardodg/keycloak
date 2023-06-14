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

        <input name="dotenv" type="hidden" value=".DOTENV" >

        <nav class="navbar bg-dark navbar-expand-lg border-bottom border-bottom-dark" data-bs-theme="dark">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                
                <div class="nav navbar-nav" id="nav-tab" role="tablist">
                  <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                  <a class="nav-link" id="nav-login-tab" data-bs-toggle="tab" data-bs-target="#nav-login" type="button" role="tab" aria-controls="nav-login" aria-selected="false" onclick="login()">Login</a>
                  <a class="nav-link" id="nav-idtoken-tab" data-bs-toggle="tab" data-bs-target="#nav-idtoken" type="button" role="tab" aria-controls="nav-idtoken" aria-selected="false" onclick="output('id-token')">idToken</a>
                  <a class="nav-link" id="nav-token-tab" data-bs-toggle="tab" data-bs-target="#nav-token" type="button" role="tab" aria-controls="nav-token" aria-selected="false" onclick="output('token')">Token</a>
                  <a class="nav-link" id="nav-refresh-tab" data-bs-toggle="tab" data-bs-target="#nav-refresh" type="button" role="tab" aria-controls="nav-refresh" aria-selected="false" onclick="output('refresh-token')">refreshToken</a>
                  <a class="nav-link" id="nav-logout-tab" data-bs-toggle="tab" data-bs-target="#nav-logout" type="button" role="tab" aria-controls="nav-logout" aria-selected="false" onclick="logout()">Logout</a>
                </div>

              </div>
            </div>
        </nav>

        <br>

        <div class="container text-center">
            <div class="row justify-content-lg-center">
                <div class="col-lg-auto">
                    <h1 class="fw-bolder">Page INDEX - Run Blade PHP</h1>
                </div>
            </div>
        </div>

        <br>

        <div class="container text-center">
          <div class="row">
            <div class="col-4">
              
              <div id="card-login" class="card" style="width: 18rem;">
                <img src="img/user.png" class="card-img-top" alt="user">
                <div class="card-body">
                  <h5 class="card-title">User Logged</h5>
                  <p class="card-text">
                     Nome: <strong id="username"></strong> <br>
                     E-mail: <strong id="mail"></strong> <br>
                     UID: <strong id="uid"></strong>
                  </p>
                </div>
              </div>

            </div>
            <div class="col-8">

              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-token" role="tabpanel" aria-labelledby="nav-token-tab" tabindex="0"> 
                  <div class="container text-start">
                            <div class="card">
                              <div class="card-header">
                                TOKEN
                              </div>
                              <div class="card-body">
                                <blockquote class="blockquote">
                                  <p id="token-base64" class="card-text"></p>
                                  <hr>
                                  <pre> 
                                    <code>
                                      <p id="token-json" class="card-text"></p>
                                    </code>
                                  </pre>
                                </blockquote>
                          </div>
                      </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="nav-idtoken" role="tabpanel" aria-labelledby="nav-idtoken-tab" tabindex="0"> 
                    <div class="container text-start">
                              <div class="card">
                                <div class="card-header">
                                  ID TOKEN
                                </div>
                                <div class="card-body">
                                  <blockquote class="blockquote">
                                    <p id="idtoken-base64" class="card-text"></p>
                                    <hr>
                                    <pre>
                                      <code>
                                      <p id="idtoken-json" class="card-text">  </p>
                                      </code>
                                    </pre>
                                  </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="nav-refresh" role="tabpanel" aria-labelledby="nav-refresh-tab" tabindex="0"> 
                    <div class="container text-start">
                              <div class="card">
                                <div class="card-header">
                                  REFRESH TOKEN
                                </div>
                                <div class="card-body">
                                  <blockquote class="blockquote">
                                    <p id="refresh-base64" class="card-text"></p>
                                    <hr>
                                    <pre> 
                                      <code>
                                      <p id="refresh-json" class="card-text"></p>
                                      </code>
                                    </pre>
                                  </blockquote>
                            </div>
                        </div>
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