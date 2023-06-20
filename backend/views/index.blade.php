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
                
                <div class="nav navbar-nav" id="nav-tab" >
                  <a class="nav-link active" type="button" href="/" >Home</a>
                  <a href="/connect" class="nav-link" type="button" >Login</a>
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
          <div class="row">

            <div class="col-auto-8">

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