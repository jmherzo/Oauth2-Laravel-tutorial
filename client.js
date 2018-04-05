const express = require('express');
const app = express();
const querystring = require('querystring');
const Client = require('node-rest-client').Client;

var client = new Client();
var port = process.env.port || 3000;

//Passport variables to change
const oauthId = 5;
const oauthRedirectUri = "http://localhost:3000/redirect";
const oauthClientSecret = "yrS5g7RE4iUB9SXNtRGZzAhi4ohIcEwyfiZnqFjs";

//  Laravel app route to authorize the Oauth app
const authUri = "http://localhost:8001/oauth/authorize";
const tokenUri= "http://localhost:8001/oauth/token";


app.get('/', (req,res)=>{
   const query = querystring.stringify({
      "client_id": oauthId,
      "redirect_uri": oauthRedirectUri,
      "response_type": "code",
      "scope" : ""
   });
   res.redirect(authUri + "?" + query);
});

app.get('/redirect', (req,res)=>{
    var args = {
        data: {
            grant_type : "authorization_code",
            client_id : oauthId ,
            client_secret : oauthClientSecret,
            redirect_uri : oauthRedirectUri,
            code : req.query.code
         },
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    };

    client.post(tokenUri, args, function (data, response) {
        // parsed response body as JS object
        console.log(data);
        res.json(data); // Respond of the GET expressjs method
    });
});

app.listen(port, function(){
   console.log('App listening on port: '+ port);
});
