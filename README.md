# Mercure

> Author: [GitHub Dunglas/Mercure](https://github.com/dunglas/mercure)  
> Article: [Symfony Blog Article](https://symfony.com/blog/symfony-gets-real-time-push-capabilities)  
> Recommendation: [Symfony Component Recommendation](https://symfony.com/doc/current/components/mercure.html)  

## Install

- Require [Docker](https://docs.docker.com/) & [Docker Compose](https://docs.docker.com/compose/)  
- Run `make start` to up/build Mercure & PHP containers  
- Run `make stop` to stop/down all containers  

## Path

> [http://localhost:8080/](http://localhost:8080/) = Server PHP  
> [http://localhost:3000/](http://localhost:3000/) = Server Mercure  

## Generate Bearer Token

- Go to [https://jwt.io/](https://jwt.io/)  
- In **PAYLOAD**, paste  

~~~bash
{
    "mercure": {
        "publish": ["*"]
    }
}
~~~

- In **VERIFY SIGNATURE**, replace `your-256-bit-secret` by `myVerySecretKey`  
- In **Encoded**, get token `eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InB1Ymxpc2giOlsiKiJdfX0.OixxclMTzRaafcsI3hP8MnpIf9v_RqQzmvSygxizYJ0`

## Call

- In **header**, add a **Bearer Tocken** and copy/paste the above token  
- in **body**, add a **form-urlencoded** and paste:

|key|value|
|--|--|
|topic|http://localhost:8080/ping|
|data|0|
