# Dental Price Comparison
 
Dental Price Comparison 

API project using PHP with Lumen.
I chose Lumen because it is a micro framework based on Laravel, that uses the principles of SOLID and with a fast development.

# Instructions

Develop a model for a dental price comparison.
Find the best supplier for a customer and calculate the best price. The customer will input
the Product Type and the requested amount.
An order cannot be split between suppliers.
Hint: No database implementation is required, data is already loaded in “memory”, you can
use hard coded values.
Please implement the solution in PHP. You may use any framework.
Pretend that you would build a real world application and structure your code so that we
theoretically could re-use it in a live system.


# Requiriments
- PHP >= 7.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension

# Installation
```bash
composer install
cp .env.example .env
php -S localhost:8000 -t public
```
# Usage

The API was documentated using POSTMAN and can be used by the file
Dental Price Comparison.postman_collection
or can be consulted by the url
https://documenter.getpostman.com/view/3587714/Uz5ArJsA

## License
[MIT](https://choosealicense.com/licenses/mit/)
