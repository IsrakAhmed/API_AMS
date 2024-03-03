# API For Account Management System


-> Step 1: Fork the repository to your github account and clone the repository to your local machine.

-> Step 2: Import accountapp.sql file to your database (phpmyadmin).

-> Step 3: Start development server with : `php -S localhost:8000` in the root directory of the project.


## API Endpoints:

1. Create new User : Method: POST
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

2. Get all Users : Method: GET
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
   
3. Get User by id : Method: GET
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
   
4. Update User : Method: PUT
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
   
5. Delete User : Method: DELETE
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
   
6. Create new Account : Method: POST
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
   
7. Get all Accounts : Method: GET
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
   
8. Get Account by id : Method: GET
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
   
9. Update Account : Method: PUT
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
   
10. Delete Account : Method: DELETE
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
    
11. Create new Transaction : Method: POST
    - URL: http://localhost:8000/transactions/insertTransaction.php
    - Request Body: 
    ```
    {
        "account_id": "1",
        "amount": "1000",
        "payment_type": "payment_type",
        "debit": "1000",
        "credit": "0",
        "reference" : "reference",
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
    
12. Get all Transactions : Method: GET
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
            "reference" : "reference",
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
            "reference" : "reference",
            "description": "description",
            "created_at": "2024-12-01 00:00:00",
            "updated_at": "2024-12-01 00:00:00"
        }
    }
    ```
    
13. Get Transaction by id : Method: GET
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
        "reference" : "reference",
        "description": "description",
        "created_at": "2024-12-01 00:00:00",
        "updated_at": "2024-12-01 00:00:00"
    }
    ```
    
14. Update Transaction : Method: PUT
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
    
15. Delete Transaction : Method: DELETE
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
    
16. Get all Customers : Method: GET
    - URL: http://localhost:8000/customers/showAllCustomers.php
    - Response: 
    ```
    {
        {
            "customer_id": "1",
            "name": "customer_name",
            "phone": "8800000000000",
            "email": "email",
            "address": "address",
            "created_at": "2024-12-01 00:00:00",
            "updated_at": "2024-12-01 00:00:00"
        },
        {
            "customer_id": "2",
            "name": "customer_name",
            "phone": "8800000000000",
            "email": "email",
            "address": "address",
            "created_at": "2024-12-01 00:00:00",
            "updated_at": "2024-12-01 00:00:00"
        }
    }
    ```
    
17. Get Customer by id : Method: GET
    - URL: http://localhost:8000/customers/showOneCustomer.php
    - Request Body: 
    ```
    {
        "customer_id": "1"
    }
    ```
    - Response: 
    ```
    {
        "customer_id": "1",
        "name": "customer_name",
        "phone": "8800000000000",
        "email": "email",
        "address": "address",
        "created_at": "2024-12-01 00:00:00",
        "updated_at": "2024-12-01 00:00:00"
    }
    ```
    
18. Create new Customer : Method: POST
    - URL: http://localhost:8000/customers/insertCustomer.php
    - Request Body: 
    ```
    {
        "name": "customer name",
        "phone": "8800000000000",
        "email": "email",
        "address": "address"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Customer record inserted"
    }
    ```
    
19. Update Customer : Method: PUT
    - URL: http://localhost:8000/customers/updateCustomer.php
    - Request Body: 
    ```
    {
        "customer_id": "1",
        "name": "customer name",
        "phone": "8800000000000",
        "email": "email",
        "address": "address"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Customer Updated Successfully"
    }
    ```
    
20. Delete Customer : Method: DELETE
    - URL: http://localhost:8000/customers/deleteCustomer.php
    - Request Body: 
    ```
    {
        "customer_id": "1"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Customer record deleted"
    }
    ```
    
21. Get all Products : Method: GET
    - URL: http://localhost:8000/products/showAllProducts.php
    - Response: 
    ```
    {
        {
            "product_id": "1",
            "name": "product name",
            "stock": "45",
            "buying_price": "100",
            "selling_price": "200",
            "description": "description",
            "created_at": "2024-12-01 00:00:00",
            "updated_at": "2024-12-01 00:00:00"
        },
        {
            "product_id": "2",
            "name": "product name",
            "stock": "45",
            "buying_price": "100",
            "selling_price": "200",
            "description": "description",
            "created_at": "2024-12-01 00:00:00",
            "updated_at": "2024-12-01 00:00:00"
        }
    }
    ```
    
22. Get Product by id : Method: GET
    - URL: http://localhost:8000/products/showOneProduct.php
    - Request Body: 
    ```
    {
        "product_id": "1"
    }
    ```
    - Response: 
    ```
    {
        "product_id": "1",
        "name": "product name",
        "stock": "45",
        "buying_price": "100",
        "selling_price": "200",
        "description": "description",
        "created_at": "2024-12-01 00:00:00",
        "updated_at": "2024-12-01 00:00:00"
    }
    ```
    
23. Create new Product : Method: POST
    - URL: http://localhost:8000/products/insertProduct.php
    - Request Body: 
    ```
    {
        "name": "product name",
        "stock": "45",
        "buying_price": "100",
        "selling_price": "200",
        "description": "description"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Product record inserted"
    }
    ```
    
24. Update Product : Method: PUT
    - URL: http://localhost:8000/products/updateProduct.php
    - Request Body: 
    ```
    {
        "product_id": "1",
        "name": "product name",
        "stock": "45",
        "buying_price": "100",
        "selling_price": "200",
        "description": "description"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Product Updated Successfully"
    }
    ```
    
25. Delete Product : Method: DELETE
    - URL: http://localhost:8000/products/deleteProduct.php
    - Request Body: 
    ```
    {
        "product_id": "1"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Product record deleted"
    }
    ```
    
26. Get all Services : Method: GET
    - URL: http://localhost:8000/services/showAllServices.php
    - Response: 
    ```
    {
        {
            "service_id": "1",
            "name": "service name",
            "selling_price": "100",
            "description": "description",
            "created_at": "2024-12-01 00:00:00",
            "updated_at": "2024-12-01 00:00:00"
        },
        {
            "service_id": "2",
            "name": "service name",
            "selling_price": "100",
            "description": "description",
            "created_at": "2024-12-01 00:00:00",
            "updated_at": "2024-12-01 00:00:00"
        }
    }
    ```
    
27. Get Service by id : Method: GET
    - URL: http://localhost:8000/services/showOneService.php
    - Request Body: 
    ```
    {
        "service_id": "1"
    }
    ```
    - Response: 
    ```
    {
        "service_id": "1",
        "name": "service name",
        "selling_price": "100",
        "description": "description",
        "created_at": "2024-12-01 00:00:00",
        "updated_at": "2024-12-01 00:00:00"
    }
    ```
    
28. Create new Service : Method: POST
    - URL: http://localhost:8000/services/insertService.php
    - Request Body: 
    ```
    {
        "name": "service name",
        "selling_price": "100",
        "description": "description"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Service record inserted"
    }
    ```
    
29. Update Service : Method: PUT
    - URL: http://localhost:8000/services/updateService.php
    - Request Body: 
    ```
    {
        "service_id": "1",
        "name": "service name",
        "selling_price": "100",
        "description": "description"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Service Updated Successfully"
    }
    ```
    
30. Delete Service : Method: DELETE
    - URL: http://localhost:8000/services/deleteService.php
    - Request Body: 
    ```
    {
        "service_id": "1"
    }
    ```
    - Response: 
    ```
    {
        "status": "true",
        "message": "Service record deleted"
    }
    ```


## Contributors:

1. [Israk Ahmed](https://github.com/IsrakAhmed)
2. [Esrat Jahan Riya](https://github.com/EsratRiya)
3. [Sumaiya Tasnim](https://github.com/SumaiyaTasnim12)
4. [Md. Shahriar Hossen Jamil](https://github.com/ShahriarJamil8009)
5. [Bakhtiar Sahib Rizvi](https://github.com/BakhtiarSahib)
