# kashbase-test

#INSTALLATION

- clone repo

```git clone git@github.com:markowitz/kashbase-test.git```

- Change directory to the repository folder

```cd kashbase-test```

- run composer update for all microservices

```sh composer-update-all.sh```

- cd into api folder and update env with db credentials

```cd api```

- run docker for all microservices

```sh run.sh```

- cd into the microservices and update the necessary third party endpoints and secret keys

- enter into the api microservice

```docker exec -it kashbase.router bash```

- then run

```php artisan migrate --seed```

#authentication

- to authentication use the following credentials

```0.0.0.0:42622/api/v1/authenticate```

```email: user@transfers.com password: password```

``` copy the access_token from the response```


#TODO

- switch authentication to laravel passport for the endpoints, to enable scopes and Oauth


#notes

- There are serveral ways microservices can communicate with each other there's RPC, Events and rest. i opted to use Events
- I also logged my response from the sms. There are other ways to monitor if the event failed.


