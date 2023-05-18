## Installation

-   Run composer install
    ```bash
    $ composer install
    ```
-   Copy the `.env.example` to `.env` file and update the file accordingly.
-   Generate key
    ```bash
    $ php artisan key:generate
    ```
-   Generate JWT key

    ```bash
    $ php artisan JWT:key
    ```

-   Generate User
    ```bash
    $ php artisan api:create-user
    ```
-   Run the migration process

    ```bash
    $ php artisan migrate:fresh --seed
    ```

-   Testing

    ```bash
    $ php artisan test
    ```

-   Serve
    ```bash
    $ php artisan serve
    ```
