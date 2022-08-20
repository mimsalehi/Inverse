How to run the project:

### Step 1

Run the following command

```shell
cp .env.example .env
composer install
```

### Step 2

Install XAMPP on your local machine and Run Apache and MySQL services.

Then Goto this Address: `http://localhost/phpmyadmin`

For `Username` enter `root` and for `Password` enter nothing.

Then create a database named `laravel` with `collation = 'utf8mb4_general_ci'` using the interface.

### Step 3

Run the following commands after successful packages installation

```shell
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### Step 4

```shell
php artisan serve
```

#### TO Run the course updater command

Use the scheduler:

```shell
php artisan schedule:run
```

Use the command:

```shell
php artisan courses:update
```

#### TO Run the course updater queue

Run this command:

```shell
php artisan queue:work --queue="courses-updater"
```

#Courses API
You can access the list of all courses using the following steps:

[LIST COURSES API](http://localhost/api/courses)

Here's a sample:

`GET http://localhost/api/courses`

```json
[
    {
        "id": 46,
        "slug": "quibusdam-suscipit-tempore-cum-eum-ut-laboriosam-nisi",
        "title": "harris.biz",
        "description": "Beatae distinctio corrupti esse. Dolor perferendis vero accusamus voluptas ut.",
        "price": 500000,
        "rating": 0.5,
        "created_at": "2022-08-19T20:33:29.000000Z",
        "updated_at": "2022-08-19T22:14:26.000000Z"
    },
    {
        "id": 47,
        "slug": "et-iste-minus-fugit-architecto-et-praesentium-enim",
        "title": "harvey.biz",
        "description": "Earum est maiores est eligendi ut id. Assumenda vitae ut ut adipisci eum harum. Quo officia itaque illo. Omnis nihil minima iste voluptas non iste.",
        "price": 1600000,
        "rating": 0.5,
        "created_at": "2022-08-19T20:33:29.000000Z",
        "updated_at": "2022-08-19T22:14:26.000000Z"
    },
    {
        "id": 48,
        "slug": "dolorem-voluptas-accusamus-ducimus-ducimus",
        "title": "cruickshank.info",
        "description": "Dolores architecto est iusto omnis qui qui. Quibusdam ut adipisci possimus sit. Similique magni consequatur ullam eligendi.",
        "price": 1800000,
        "rating": 4.5,
        "created_at": "2022-08-19T20:33:29.000000Z",
        "updated_at": "2022-08-19T22:14:27.000000Z"
    }
]
```

Then you can search among the list of courses by sending a query parameters such as rating, title, slug, description,
min_price, max_price, and rating. Please read following example:

`GET http://localhost/api/courses?min_price=2000000&max_price=3000000`

The output of this path is equal to all the courses whose price is between 2 million and 3 million tomans.

Also, to sort the results, you need to send two keys (sort_key, sort_dir) as a parameter query. Consider the example
below. This example sorts the list of courses by their price in descending order.

`GET http://localhost/api/courses?min_price=2000000&max_price=3000000&sort_key=price&sort_dir=desc`


#Sales API
List of courses with how many and how much they sold each month are avaibale in the following path,
Also you can access to popular courses by adding query param to GET request, Please see the following example:

[LIST SALES API](http://localhost/api/courses/sales)

in the above sample, you can access to popularity of each course descending Here's sample response:

`GET http://localhost/api/courses/sales`

```json
[
    {
        "id": 12,
        "title": "stark.biz",
        "price": 1400000,
        "sales": {
            "August": {
                "count": 4,
                "sales": 5600000
            },
            "May": {
                "count": 10,
                "sales": 14000000
            },
            "April": {
                "count": 9,
                "sales": 12600000
            },
            "July": {
                "count": 5,
                "sales": 7000000
            },
            "June": {
                "count": 7,
                "sales": 9800000
            },
            "March": {
                "count": 2,
                "sales": 2800000
            }
        },
        "popularity": 37,
        "total_sales": 51800000
    },
    {
        "id": 7,
        "title": "gaylord.net",
        "price": 2900000,
        "sales": {
            "August": {
                "count": 5,
                "sales": 14500000
            },
            "July": {
                "count": 7,
                "sales": 20300000
            },
            "June": {
                "count": 9,
                "sales": 26100000
            },
            "March": {
                "count": 3,
                "sales": 8700000
            },
            "April": {
                "count": 4,
                "sales": 11600000
            },
            "May": {
                "count": 6,
                "sales": 17400000
            }
        },
        "popularity": 34,
        "total_sales": 98600000
    }
]
```

