Docker
======
```
[sudo?]
docker-compose build
docker-compose up
```
=> http://localhost


Endpoints
=========
- Get all products of a cart
    - [GET] /api/v1/cart/{cartId}/products
- Add a product to a cart
    - [POST] /api/v1/cart/{cartId}/product/{productId}

ToDos
=====
- Use Redis
- Define/extend entity (maybe 1 Product can be x times in the cart)
- Add memcached / redis to docker
