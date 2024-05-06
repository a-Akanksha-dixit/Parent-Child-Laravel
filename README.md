```markdown
# Laravel Parent-Child Management System

This project is a simple Laravel application for managing parent and child information.

## Installation

1. Clone the repository to your local machine:

```bash
git clone https://github.com/a-Akanksha-dixit/Parent-Child-Laravel.git
```

2. Navigate into the project directory:

```bash
cd laravel-parent-child
```

3. Install dependencies using Composer:

```bash
composer install
```

4. Copy the .env.example file to .env:

```bash
cp .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Create a new database and configure the database connection in the .env file.

7. Run database migrations to create tables:

```bash
php artisan migrate
```

8. Start the Laravel development server:

```bash
php artisan serve
```

## Usage

This application provides the following features:

- **Submit Parent and Child Information:** Endpoint to submit parent and child information.
- **Get Siblings of a Child:** Endpoint to retrieve siblings of a given child.
- **Get Child Information by ID:** Endpoint to retrieve information of a child by ID.
- **Get Parent Information by Child ID:** Endpoint to retrieve parent information based on the child ID.
- **Get All Children of a Parent:** Endpoint to retrieve all children of a parent.
## API Routes

- **Submit Parent and Child Information:** `POST /api/submit`
  - This endpoint allows you to submit information about a parent and child. It expects the following parameters:
    - `father_name`: The name of the father (required, string, minimum length: 3).
    - `mother_name`: The name of the mother (required, string, minimum length: 3).
    - `child_name`: The name of the child (required, string, minimum length: 3).
  - Example usage:
    ```bash
    curl --location 'http://127.0.0.1:8000/api/submit' \
    --header 'Content-Type: application/json' \
    --data '{
        "father_name" : "sanjeev",
        "mother_name" : "meera",
        "child_name" : "varsha"
    }'
    ```

- **Get Siblings of a Child:** `GET /api/sibling/{childId}`
  - This endpoint retrieves the siblings of a child based on the child's ID.
  - Example usage:
    ```bash
    curl http://localhost:8000/api/sibling/1
    ```

- **Get Child Information by ID:** `GET /api/child/{childId}`
  - This endpoint retrieves information about a child based on the child's ID.
  - Example usage:
    ```bash
    curl http://localhost:8000/api/child/1
    ```

- **Get Parent Information by Child ID:** `GET /api/parents/{childId}`
  - This endpoint retrieves information about the parent of a child based on the child's ID.
  - Example usage:
    ```bash
    curl http://localhost:8000/api/parents/1
    ```

- **Get All Children of a Parent:** `GET /api/childs/{parentId}`
  - This endpoint retrieves all children of a parent based on the parent's ID.
  - Example usage:
    ```bash
    curl http://localhost:8000/api/childs/1
    ```

## Contributors

- [Akanksha Dixit](https://github.com/a-Akanksha-dixit)

## License

This project is licensed under the [MIT License](LICENSE).
```