# Kashbase Test

## Written in Laravel ❤️

## Tasks

Create 3 Microservices (Bank Transfer, SMS, Payment)

 - Transfer (Paystack)
 - Payment (Paystack Service)
 - SMS (my.sendchamp.com)
      - A user should be able to transfer fund and receive SMS
      - A user should be able to pay and receive SMS

## How to setup

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


## Routes

- url `POST` ```{base_url}/api/v1/authenticate```

     - params

     > `{ 
     >
     >     email:user@transfers.com
     >
     >     password:password
     >
     >    `}

- url `POST` ```{base_url}/api/v1/transfer/initiate```

      - params

      > `{ 
      >
      >     account_number:0000000000
      >
      >     bank_code:011
      >
      >    `}

- url `POST` ```{base_url}/api/v1/transfer/send```

      - params

      > `{ 
      >
      >     amount:100000
      >
      >     recipient:RCP_t2o5h99jc55q54n
      >
      >     reason:flex bro
      >
      >     currency:NGN
      >    `}


- url `POST` ```{base_url}/api/v1/transfer/finalize```

      - params

      > `{ 
      >
      >     otp:864970
      >
      >     transfer_code:TRF_ihoddl0d1rajkzf
      >    `}


- url `POST` ```{base_url}/api/v1/payments/pay```

      - params

      > `{ 
      >
      >     email:user@transfers.com
      >
      >     amount:100000
      >    `}


### Notes
- for the authentication i used laravel sanctum, for better authentication we can use laravel passport  for better security and access level to endpoints.
- There are serveral ways microservices can communicate with each other there's RPC, Events and rest. i opted to use Events
- I also logged my response from the sms. There are other ways to monitor if the event failed.



