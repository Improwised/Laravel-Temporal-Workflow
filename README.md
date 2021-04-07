## Temporal Integration with Laravel


1. Make sure you have PHP 7.4 and laravel 8.* , or higher, installed.

2. Temploral PHP SDK is available as composer package and can be installed using the following command in a root of your project:

    ```sh
    $ composer require temporal/sdk
    ```

3. Install the gRPC PHP extension

    The PHP gRPC engine extension must be installed and activated in order to communicate with the Temporal Server.

    Follow the instructions here: https://cloud.google.com/php/grpc

    Make sure you follow the all the steps to activate the gRPC extension in your php.ini file and install the protobuf runtime library in your project.

4. Download RoadRunner application server

   The Temporal PHP SDK requires the RoadRunner 2.0 application server and supervisor to run Activities and Workflows in a scalable way.

    ```sh
    $ composer require spiral/roadrunner:v2.0 nyholm/psr7
    $ ./vendor/bin/rr get-binary
    ```

    Note: You can install RoadRunner manually by downloading its binary from the [release page](https://github.com/spiral/roadrunner/releases/tag/v1.9.2).

5. Run the Temporal Server

    Download and Start Temporal Server Locally
    Execute the following commands to start a pre-built image along with all the dependencies.

    ```sh
    git clone https://github.com/temporalio/docker-compose.git
    cd docker-compose
    docker-compose up
    ```
    Refer to Temporal [docker-compose](https://github.com/temporalio/docker-compose) repo for more advanced options.


    The Temporal Server must be up and running for the samples to work.

6. Update configuration Make sure to update the temporal address in .rr.yaml to localhost:7233.

7. Start the application using RoadRunner

    To start the application using RoadRunner:

    ```sh
    $ ./rr serve -c ./.rr.yaml
    ```
    You can now interact with the samples.

    Note: You can alter number of PHP Workers in .rr.yaml.
