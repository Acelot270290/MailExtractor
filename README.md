
# Email Processing API

This is a Laravel-based API for processing email content, extracting plain text from raw email payloads, and managing email records. The API is secured with JWT authentication.

## Features

- **Email Processing Command:** Parses raw email content, extracts plain text, and stores it in the database. The command runs hourly and skips already processed emails.
- **JWT Authentication:** Secures the API endpoints.
- **CRUD Endpoints:** 
  - **Create:** Store a new email record and automatically parse the raw email content.
  - **Read:** Get a specific email by ID or get all email records.
  - **Update:** Modify an existing email record.
  - **Delete:** Soft delete an email record.

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/email-processing-api.git
cd email-processing-api
```
### 2. Up Docker

```bash
docker-compose up -d
```

### 3. Install Dependencies

```bash
composer install
```

### 4. Set Up Environment Variables

- Copy the example environment file to create your `.env` file:

```bash
cp .env.example .env
```

- Update the `.env` file with your database and JWT configuration.

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Generate JWT Secret

```bash
php artisan jwt:secret
```

### 7. Run Migrations

```bash
php artisan migrate
```

### 8. Seed the Database

You can seed the database with an admin user using the following command:

```bash
php artisan db:seed --class=AdminSeeder
```

### 9. Run the Application

You can serve the application locally using:

```bash
php artisan serve
```

The API will be available at `http://localhost:8000` or the port specified.

### 10. Running with Docker

If you prefer to use Docker, follow these steps:

1. **Build the Docker containers:**

   ```bash
   docker-compose up --build
   ```

2. **Run migrations inside the Docker container:**

   ```bash
   docker-compose exec app php artisan migrate
   ```

3. **Seed the database:**

   ```bash
   docker-compose exec app php artisan db:seed --class=AdminSeeder
   ```

4. **Access the application:**

   The application will be accessible at `http://localhost:85` or the port specified in your Docker configuration.

## API Endpoints

All endpoints are prefixed with `/api/email` and are protected by JWT authentication.

### Authentication

**Login**

- **Endpoint:** `POST /api/login`
- **Body:**
  ```json
  {
    "email": "contato@alandiniz.com.br",
    "password": "123456789"
  }
  ```
- **Response:**
  ```json
  {
    "access_token": "your_jwt_token_here",
    "token_type": "bearer",
    "expires_in": 3600
  }
  ```

### CRUD Operations

**Create Email**

- **Endpoint:** `POST /api/email`
- **Headers:** 
  - `Authorization: Bearer your_jwt_token_here`
- **Body:**
  ```json
  {
    "affiliate_id": 123,
    "envelope": "Some envelope data",
    "from": "sender@example.com",
    "subject": "Test Subject",
    "dkim": "Some dkim value",
    "SPF": "Some SPF value",
    "spam_score": 0.5,
    "email": "Some raw email content",
    "raw_text": "Plain text extracted from email",
    "sender_ip": "192.168.1.1",
    "to": "recipient@example.com",
    "timestamp": 1628472947
  }
  ```

**Get Email by ID**

- **Endpoint:** `GET /api/email/{id}`
- **Headers:** 
  - `Authorization: Bearer your_jwt_token_here`

**Update Email**

- **Endpoint:** `PUT /api/email/{id}`
- **Headers:** 
  - `Authorization: Bearer your_jwt_token_here`
- **Body:** (Similar to the create body)

**Get All Emails**

- **Endpoint:** `GET /api/email`
- **Headers:** 
  - `Authorization: Bearer your_jwt_token_here`

**Delete Email**

- **Endpoint:** `DELETE /api/email/{id}`
- **Headers:** 
  - `Authorization: Bearer your_jwt_token_here`

## Running the Command Manually

You can manually run the email processing command using:

```bash
php artisan emails:parse
```

This command will process all unprocessed emails, extracting the plain text content.

## Deployment

Ensure that all environment variables are properly set on the production server and run the following commands:

```bash
composer install --optimize-autoloader --no-dev
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan serve --port=80 --host=0.0.0.0
```

## Troubleshooting

If you encounter any issues:

1. Clear the application cache:
   ```bash
   php artisan config:cache
   php artisan cache:clear
   ```

2. Ensure your `.env` file is properly configured and reflects your environment.
