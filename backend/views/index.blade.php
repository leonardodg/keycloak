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

                  @if ($logged)
                    <a href="/admin" class="nav-link" type="button" >Admin</a>
                  @else
                    <a href="/connect" class="nav-link" type="button" >Login</a>
                  @endif

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
          <div class="row justify-content-md-center">
            <div class="col-md-auto">
              <div class="card">
                <div class="card-header">
                  Configurações 
                </div>
      
                <div class="card-body">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">URL</span>
                    <input name="KEYCLOAK_URL" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{ $url }}" disabled >
                  </div>
      
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Realm</span>
                    <input name="KEYCLOAK_REALM" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{ $realm }}" disabled >
                  </div>
      
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">ClientID</span>
                    <input name="KEYCLOAK_CLIENTID" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{ $client_id }}" disabled >
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