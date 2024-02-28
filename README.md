# API For Account Management System


-> Step 1: Fork the repository to your github account and clone the repository to your local machine.

-> Step 2: Import accountapp.sql file to your database (phpmyadmin).

-> Step 3: Start development server with : `php -S localhost:8080` in the root directory of the project.


## API Endpoints:

1. Create new user : Method: POST
    - URL: http://localhost:8000/users/insertUser.php
    - Request Body: 
    ```
    {
        "username": "username",
        "password": "password",
        "fullname": "fullname",
        "phone": "8800000000000",
        "email": "email@email.com",
        "address": "address"
    }
    ```
    - Response: 
    ```
    {
         "status": "true",
         "message": "User Record inserted"
    }
    ```

2. Get all users : Method: GET
    - URL: http://localhost:8000/users/showAllUsers.php
    - Response: 
    ```
    {
          {
                "userid": "1",
                "username": "username",
                "password": "password",
                "fullname": "fullname",
                "phone": "8800000000000",
                "email": "email",
                "address": "address"
          },
          {
                "userid": "2",
                "username": "username",
                "password": "password",
                "fullname": "fullname",
                "phone": "8800000000000",
                "email": "email",
                "address": "address"
          }
     ]
    }
    ```
   
3. Get user by id : Method: GET
    - URL: http://localhost:8000/users/showOneUser.php
    - Request Body: 
    ```
    {
        "userid": "1"
    }
    ```
    - Response: 
    ```
    {
        "userid": "1",
        "username": "username",
        "password": "password",
        "fullname": "fullname",
        "phone": "8800000000000",
        "email": "email",
        "address": "address"
    }
    ```
   
4. Update user : Method: PUT
    - URL: http://localhost:8000/users/updateUser.php
    - Request Body: 
    ```
    {
        "userid": "1",
        "username": "username",
        "password": "password",
        "fullname": "fullname",
        "phone": "8800000000000",
        "email": "email",
        "address": "address"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "User Updated Successfully"
    }
    ```
   
5. Delete user : Method: DELETE
    - URL: http://localhost:8000/users/deleteUser.php
    - Request Body: 
    ```
    {
        "userid": "1"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "User record deleted"
    }
    ```