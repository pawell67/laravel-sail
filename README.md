#Installation

`git clone https://github.com/pawell67/laravel-sail.git`

`cd laravel-sail`

`cp .env.example .env`

`composer install --ignore-platform-reqs`

`./vendor/bin/sail up -d`

`./vendor/bin/sail artisan key:generate`

`./vendor/bin/sail artisan migrate`

##Task 1:

Create a new Laravel project using composer
Attached you will find a DB dump. Create a DB connection in laravel using the .env file.
Seed the DB based on the dump
In the resulted DB you will have these 3 tables: `users`, `countries` and `user_details`.
```
* users: id, email, active
* countries: id, name, iso2, iso3 
* user_details: id, user_id, citizenship_country_id, first_name, last_name, phone_number
```
1. Create a call which will return all the users which are `active` (users table) and have an Austrian citizenship.
2. Create a call which will allow you to edit user details just if the user details are there already.
3. Create a call which will allow you to delete a user just if no user details exist yet.
4. Write a feature test for 3. with valid and invalid data
Tips:
- you can use Eloquent to simplify (eg: model binding)

###Endpoints: 

Users:

```[GET] /api/v1/users```

Active users with austrian citizenship:

```
[GET] /api/v1/users?status=active&country=aut
```
```
[GET] /api/v1/users?status=active&country=AU
```
```
[GET] /api/v1/users?status=active&country=austria
```
```
[GET] /api/v1/users?status=active&country=Austria
```

Edit user details (if details exists) [PUT] curl with json:
```
curl --location --request PUT '0.0.0.0/api/v1/users/1/details' \
--header 'Content-Type: application/json' \
--data-raw '{
"first_name": "Test",
"last_name":"User",
"phone_number":"0023432432432",
"country":"fra"
}'
```
Delete user with id (if no details exists):

```
[DELETE] /api/v1/users/{id}
```
##Task 2:

Create a new Laravel project using composer
Attached you will find a DB dump and a .csv file.
Create a DB connection in laravel using the .env file.
Seed the DB based on the dump
In the resulted DB you will have these 1 table: `transactions`.
```
* transactions: id, code, amount, user_id, created_at, updated_at
```
You have two sources. One DB and one is the .csv file
Write two services(classes) that implement an interface which will allow you to retrieve the data.
1. Create an endpoint which will return the transactions in a json with an extra parameter which will specify the source

endpoints:
* .../transactions?source=db
* .../transactions?source=csv

Some ideas:
- you can create a factory to determine the class handler
- you can also validate the source value and if the value is unknown throw an exception (eg: /transactions?source=html)

###Endpoints:
```
[GET] /api/v1/transactions?source=db
```
```
[GET] /api/v1/transactions?source=csv
```
```
[GET] /api/v1/transactions?source=html
```
```
[GET] /api/v1/transactions
```
##Tests:
`./vendor/bin/sail artisan test`
