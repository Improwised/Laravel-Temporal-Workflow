## Temporal Integration with Laravel ##

**Step 1: Make sure you have PHP 7.4 and laravel 8, or higher, installed.**

**Step 2: Temploral PHP SDK is available as composer package and can be installed using the following command in a root of your project:**

```sh
    $ composer require temporal/sdk
```

**Step 3: Install the gRPC PHP extension**

The PHP gRPC engine extension must be installed and activated in order to communicate with the Temporal Server.

Follow the instructions here: https://cloud.google.com/php/grpc

Make sure you follow the all the steps to activate the gRPC extension in your php.ini file and install the protobuf runtime library in your project.

**Step 4: Download RoadRunner application server**

   The Temporal PHP SDK requires the RoadRunner 2.0 application server and supervisor to run Activities and Workflows in a scalable way.

```sh
    $ composer require spiral/roadrunner:v2.0 nyholm/psr7
    $ ./vendor/bin/rr get-binary
```

Note: You can install RoadRunner manually by downloading its binary from the [release page](https://github.com/spiral/roadrunner/releases/tag/v1.9.2).

**Step 5: Run the Temporal Server**

Download and Start Temporal Server Locally
Execute the following commands to start a pre-built image along with all the dependencies.

```sh
    git clone https://github.com/temporalio/docker-compose.git
    cd docker-compose
    docker-compose up
```

Refer to Temporal [docker-compose](https://github.com/temporalio/docker-compose) repo for more advanced options.


The Temporal Server must be up and running for the samples to work.

**Step 6: Update configuration**
 Make sure to update the temporal address in .rr.yaml to localhost:7233.

**Step 7: Start the application using RoadRunner**

To start the application using RoadRunner:

```sh
    $ ./rr serve -c ./.rr.yaml
 ```
    
In rr.yaml the command, set is Laravel Custom Command created to register all the workflows and acitivy. 


## How to Setup Locally? ##
 
**Step 1: Install Composer Dependancy**

```sh
    $ composer install
```
**Step 2 : Install node dependancy**

```sh
    $ npm install
```
and
```sh
    $ npm run dev
```   
to build all the javaScript files and CSS we need for our app

**Step 3: Database Setup**

Open the .env file on your IDE or text editor and change the `DB_DATABASE` to the name of your database and if you have set a Username and password

**Step 4: Mail Driver Setup**

As per your application need set up mail driver, for local testing and debugging , you may set it to log

**Step 5: Run Migration**

```sh
    $ php artisan migrate
```   
**Step 6: Run App**

```sh
    $ php artisan serve
```  
There you go, setup is done !!

Start using the application, go to `/register` and do the signup, on signup user will receive the welcome mail through temporal activity