var eleCardLogin = document.getElementById('card-login');
var eleTextUsername = document.getElementById('username');
var eleTextMail = document.getElementById('mail');
var eleTextUID = document.getElementById('uid');
var eleButLogin = document.getElementById('nav-login-tab');
var eleButToken = document.getElementById('nav-token-tab');
var eleButIdToken = document.getElementById('nav-idtoken-tab');
var eleButRefresh = document.getElementById('nav-refresh-tab');
var eleButLogout = document.getElementById('nav-logout-tab');

var dotenv = document.getElementsByName('dotenv')[0].value;
var env = dotenv.split(";");
var config = []; // NAME INPUTS CONFIG
var load, keycloak;
var change = window.sessionStorage.getItem('change');

// START - INIT
eleCardLogin.style.display = "none";
eleButToken.style.display = "none";
eleButIdToken.style.display = "none";
eleButRefresh.style.display = "none";
eleButLogout.style.display = "none";

// CONVERT STRING TO ARRAY OBJECT VARIABLES IN ENVIRONMENT FILE .ENV 
env.pop();
if(env.length) {
  env = env.map(function (item) {
    let i = item.split("=");
    let result = { name: i[0], value: i[1] };
    result[i[0]] = i[1];
    config.push(i[0]);
    return result;
  });
}

// Register Logs
function events(text, textClass) {
  let elCardLogs = document.getElementById('card-logs');
  console.log('>> Evento: '+ text);
  elCardLogs.innerHTML = elCardLogs.innerHTML + ' \t <p class="card-text '+textClass+'"> <b>'+ new Date().toLocaleString() + ': </b>' +text+ '</p> \n';
}

// SET VALUE DEFAULT IN ENV TO INPUT
function resetenv() {
  console.log('reset');
  env.map(function (item) {
    document.getElementsByName(item.name)[0].value = item.value;
    window.sessionStorage.setItem(item.name, item.value);
  });

  if(change){
    window.sessionStorage.removeItem('change');
  }

  events(">> Load Config Init", "text-info");
}

console.log(config);
console.log(env);

load = (function loading() {

  if(change){
    config.map(function (item) {
      document.getElementsByName(item)[0].value = window.sessionStorage.getItem(item);
    });
  }else{
    resetenv();
  }

  keycloak = new Keycloak({
    url: window.sessionStorage.getItem('KEYCLOAK_URL'),
    realm:  window.sessionStorage.getItem('KEYCLOAK_REALM'),
    clientId:  window.sessionStorage.getItem('KEYCLOAK_CLIENTID'),
    enableLogging : true
  });

  console.log('load');
  initKeycloak();

  events(">> keycloak Start", "text-info");

  return loading;
}());


function salve() {
  config.map(function (item) {
    let val = document.getElementsByName(item)[0].value;
    console.log(item + ":" + val);
    window.sessionStorage.setItem(item, val);
  });

  window.sessionStorage.setItem('change', true);

  keycloak = new Keycloak({
    url: window.sessionStorage.getItem('KEYCLOAK_URL'),
    realm:  window.sessionStorage.getItem('KEYCLOAK_REALM'),
    clientId:  window.sessionStorage.getItem('KEYCLOAK_CLIENTID'),
    enableLogging : true
  });

  events(">> keycloak Reload by new config", "text-info");

  initKeycloak();
}

function login(){
  console.log('login func');
  events(">> keycloak Function Login", "text-info");
  keycloak.login();
}

function logout(){
  console.log('func logout');
  keycloak.logout();
  events(">> keycloak Function Logout", "text-info");
  eleCardLogin.style.display = "none";
}

function output(option) {
  let data, token, eleTextJson, eleTextBase;

  switch (option) {
    case 'token':
                eleTextJson = document.getElementById('token-json');
                eleTextBase = document.getElementById('token-base64');
              
                data = keycloak.tokenParsed;
                token = keycloak.token;
          break;
      case 'id-token':
                eleTextJson = document.getElementById('idtoken-json');
                eleTextBase = document.getElementById('idtoken-base64');

                data = keycloak.idTokenParsed;
                token = keycloak.idToken;
          break;
      case 'refresh-token':
                eleTextJson = document.getElementById('refresh-json');
                eleTextBase = document.getElementById('refresh-base64');

                data = keycloak.refreshTokenParsed;
                token = keycloak.refreshToken;
          break;
    default:
            data = 'No Data';
            token = 'No Token';
      break;
  }

  events(">> keycloak show info", "text-info");

  if (typeof data === 'object') {
    data = JSON.stringify(data, null, '  ');
  }

  eleTextJson.innerHTML = data;
  eleTextBase.innerHTML = token;
}

async function request() {
  const url = document.getElementById('url').value;
  const includeAccessToken = document.getElementById('include_access_token').checked;
  const result = await fetch(url,  {
    headers: includeAccessToken ? {
      'Authorization' : `Bearer ${keycloak.token}`
    } : undefined
  });
  const resultText = await result.text();

  output(`Status: ${result.status} <br/>Content: ${resultText}`);
}

function initKeycloak() {
  keycloak.init({
    onLoad: 'check-sso'
  }).then(function(authenticated) {
    console.log(authenticated);
    console.log(authenticated ? 'authenticated' : 'not authenticated');

    if(authenticated){
      events(">> keycloak Authenticated SUCCESS!", "text-success");
    }else{
      events(">> keycloak Authenticated FAILD!", "text-danger");
    }
  }).catch(function(error) {
    console.log(error);
    console.log('failed to initialize');
    events(">> keycloak Authenticated FAILD!", "text-danger");
  });
}

keycloak.onAuthSuccess = async function () {
  const user = await keycloak.loadUserInfo();
  eleTextUsername.innerHTML = `${user.name}`;
  eleTextUID.innerHTML = keycloak.subject;
  eleTextMail.innerHTML = `${user.email}`;

  console.log(user);

  eleCardLogin.style.display = "block";
  eleButLogout.style.display = "block";
  eleButToken.style.display = "block";
  eleButIdToken.style.display = "block";
  eleButRefresh.style.display = "block";

  eleButLogin.style.display = "none";
};