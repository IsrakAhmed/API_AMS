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
                "address": "address",
                "created_at": "2024-12-01 00:00:00",
                "updated_at": "2024-12-01 00:00:00"
          },
          {
                "userid": "2",
                "username": "username",
                "password": "password",
                "fullname": "fullname",
                "phone": "8800000000000",
                "email": "email",
                "address": "address",
                "created_at": "2024-12-01 00:00:00",
                "updated_at": "2024-12-01 00:00:00"
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
        "address": "address",
        "created_at": "2024-12-01 00:00:00",
        "updated_at": "2024-12-01 00:00:00"
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
   
6. Create new account : Method: POST
    - URL: http://localhost:8000/accounts/insertAccount.php
    - Request Body: 
    ```
    {
        "userid": "1",
        "account_title": "account_title",
        "account_type": "account_type",
        "balance": "1000",
        "bank_name": "bank_name",
        "branch_name": "branch_name"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Account record inserted"
    }
    ```
   
7. Get all accounts : Method: GET
    - URL: http://localhost:8000/accounts/showAllAccounts.php
    - Response: 
    ```
    {
        {
            "account_id": "1",
            "userid": "1",
            "account_title": "account_title",
            "account_type": "account_type",
            "balance": "1000",
            "bank_name": "bank_name",
            "branch_name": "branch_name",
            "created_at": "2024-12-01 00:00:00",
            "updated_at": "2024-12-01 00:00:00"
        },
        {
            "account_id": "2",
            "userid": "1",
            "account_title": "account_title",
            "account_type": "account_type",
            "balance": "1000",
            "bank_name": "bank_name",
            "branch_name": "branch_name",
            "created_at": "2024-12-01 00:00:00",
            "updated_at": "2024-12-01 00:00:00"
        }
    }
    ```
   
8. Get account by id : Method: GET
    - URL: http://localhost:8000/accounts/showOneAccount.php
    - Request Body: 
    ```
    {
        "account_id": "1"
    }
    ```
    - Response: 
    ```
    {
        "account_id": "1",
        "userid": "1",
        "account_title": "account_title",
        "account_type": "account_type",
        "balance": "1000",
        "bank_name": "bank_name",
        "branch_name": "branch_name",
        "created_at": "2024-12-01 00:00:00",
        "updated_at": "2024-12-01 00:00:00"
    }
    ```
   
9. Update account : Method: PUT
    - URL: http://localhost:8000/accounts/updateAccount.php
    - Request Body: 
    ```
    {
        "account_id": "1",
        "userid": "1",
        "account_title": "account_title",
        "account_type": "account_type",
        "balance": "1000",
        "bank_name": "bank_name",
        "branch_name": "branch_name"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Account Updated Successfully"
    }
    ```
   
10. Delete account : Method: DELETE
    - URL: http://localhost:8000/accounts/deleteAccount.php
    - Request Body: 
    ```
    {
        "account_id": "1"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Account record deleted"
    }
    ```
    
11. Create new transaction : Method: POST
    - URL: http://localhost:8000/transactions/insertTransaction.php
    - Request Body: 
    ```
    {
        "account_id": "1",
        "amount": "1000",
        "payment_type": "payment_type",
        "debit": "1000",
        "credit": "0",
        "reference" = "reference",
        "description": "description"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Transaction Created Successfully"
    }
    ```
    
12. Get all transactions : Method: GET
    - URL: http://localhost:8000/transactions/showAllTransactions.php
    - Response: 
    ```
    {
        {
            "transaction_id": "1",
            "account_id": "1",
            "amount": "1000",
            "payment_type": "payment_type",
            "debit": "1000",
            "credit": "0",
            "reference" = "reference",
            "description": "description",
            "created_at": "2024-12-01 00:00:00",
            "updated_at": "2024-12-01 00:00:00"
        },
        {
            "transaction_id": "2",
            "account_id": "1",
            "amount": "1000",
            "payment_type": "payment_type",
            "debit": "1000",
            "credit": "0",
            "reference" = "reference",
            "description": "description",
            "created_at": "2024-12-01 00:00:00",
            "updated_at": "2024-12-01 00:00:00"
        }
    }
    ```
    
13. Get transaction by id : Method: GET
    - URL: http://localhost:8000/transactions/showOneTransaction.php
    - Request Body: 
    ```
    {
        "transaction_id": "1"
    }
    ```
    - Response: 
    ```
    {
        "transaction_id": "1",
        "account_id": "1",
        "amount": "1000",
        "payment_type": "payment_type",
        "debit": "1000",
        "credit": "0",
        "reference" = "reference",
        "description": "description",
        "created_at": "2024-12-01 00:00:00",
        "updated_at": "2024-12-01 00:00:00"
    }
    ```
    
14. Update transaction : Method: PUT
    - URL: http://localhost:8000/transactions/updateTransaction.php
    - Request Body: 
    ```
    {
        "transaction_id": "1",
        "account_id": "1",
        "amount": "1000",
        "payment_type": "payment_type",
        "debit": "1000",
        "credit": "0",
        "reference" = "reference",
        "description": "description"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Transaction Updated Successfully"
    }
    ```
    
15. Delete transaction : Method: DELETE
    - URL: http://localhost:8000/transactions/deleteTransaction.php
    - Request Body: 
    ```
    {
        "transaction_id": "1"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Transaction record deleted"
    }
    ```
    

## Contributors:

1. [Israk Ahmed](https://github.com/IsrakAhmed)
2. [Esrat Jahan Riya](https://github.com/EsratRiya)
3. [Sumaiya Tasnim](https://github.com/SumaiyaTasnim12)
4. [Md. Shahriar Hossen Jamil](https://github.com/ShahriarJamil8009)
5. [Bakhtiar Sahib Rizvi](https://github.com/BakhtiarSahib)