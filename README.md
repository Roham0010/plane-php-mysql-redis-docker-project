!!! This is just a
## Explanation
These are the things I have done:
- Dockerized the project, creating three containers: PHP, MySQL, and Redis.
- Created two entities: User and Transaction.
- Set up repositories for handling database operations using PDO.
- Developed services for business logic related to users and transactions.
- Implemented various commands for application functionality
- Implemented Redis caching
- Configured PHPUnit for testing.
- Created a Makefile to simplify common tasks and commands.
## Prerequisites

Ensure you have the following installed on your machine:
- Docker
- Docker Compose
- Make (optional but recommended for using `make` commands)

## Environment Variables

There are two environment files handeled for the test and also dev:
- `.env`
- `.env.test`
## Install dependencies
   ```sh
   composer install
   ```
## Installation
1. **Build Docker Containers**:
   ```sh
   make up
   ```
   OR
   ```sh
   docker compose up -d --build
   ```

## Migrations and seeding
1. Migration
   ```sh
   make app-migrate
   ```
   OR
   ```sh
   docker compose exec app php bin/console app:migrate
   ```
2. Seeding the users table
   ```sh
   make app-populate-users
   ```
   OR
   ```sh
   docker compose exec app php bin/console app:populate-users
   ```

## Functional App Commands


1. **Create Transaction**:
   ```sh
   make app-create-transaction USER_ID=<user_id> AMOUNT=<amount>
   ```
   OR
   ```sh
   docker compose exec app php bin/console app:create-transaction --user-id <user_id> --amount <amount>
   ```

2. **Generate Report**:
* This command generates transaction reports based on the specified type option.

   There are two types of reports available:
   1. per_user_per_day: Generates a report of transactions grouped by each user for each day.
   2. all_users_per_day: Generates a report of transactions for all users combined for each day.

   ```sh
   make app-generate-report TYPE=[per_user_per_day|all_users_per_day]
   ```
   OR
   ```sh
   docker compose exec app php bin/console app:generate-report --type [per_user_per_day|all_users_per_day]
   ```

3. **Get Data by Type**:
   ```sh
   make app-get TYPE=<type>
   ```
   OR
   ```sh
   docker compose exec app php bin/console app:get --type <type>
   ```

4. **Get All Users**:
   ```sh
   make app-get-users
   ```
   OR
   ```sh
   docker compose exec app php bin/console app:get-users
   ```

## Testing

**Run Tests by**:
   ```sh
   make test
   ```
OR
   ```sh
   docker compose exec app ./vendor/bin/phpunit
   ```

# By document commands:
0. First Migrate:
   ```sh
   make app-migrate
   ```
   OR
   ```sh
   docker compose exec app php bin/console app:migrate
   ```
1. We should be able to populate list of users by random info (We can use a faker to do that).
   ```sh
   make app-populate-users
   ```
   OR
   ```sh
   docker compose exec app php bin/console app:populate-users
   ```

2. We should be able to do a transaction for specific user and for a specific day. Do every caution system needs to do a transaction.
   ```sh
   make app-create-transaction USER_ID=<user_id> AMOUNT=<amount>
   ```
   OR
   ```sh
   docker compose exec app php bin/console app:create-transaction --user-id <user_id> --amount <amount>
   ```
3. We should be able to get a report of total transaction amount for each user per day.
   ```sh
   make app-generate-report TYPE=per_user_per_day
   ```
4. We should be able to get a report of total transactions amount for all user per day. Use a layer of cache here.
   ```sh
   make app-generate-report TYPE=all_users_per_day
   ```
5. Write test cases which you think they are necessary. If you don't have time to implement all test cases, you can only define them and
mark them as incomplete.
   ```sh
   make test
   ```
   OR
   ```sh
   docker compose exec app ./vendor/bin/phpunit
   ```
