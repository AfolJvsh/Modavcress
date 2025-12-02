# Task Manager API

A modern REST API for managing tasks, built with Laravel. This backend service powers a full-stack task management application with a clean, intuitive interface. It provides a robust API for creating, reading, updating, and deleting tasks with support for task status tracking.

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
- [API Endpoints](#api-endpoints)
- [Frontend Integration](#frontend-integration)
- [Code Review Notes](#code-review-notes)

---

## Features

✅ **RESTful API** - Clean, standardized endpoints for task management  
✅ **Task Status Tracking** - Organize tasks with three statuses: Todo, In Progress, Done  
✅ **Timestamps** - Automatic creation and update timestamps  
✅ **API Authentication** - Laravel Sanctum for secure API token authentication  
✅ **Input Validation** - Robust validation for all API requests  
✅ **Testing Ready** - Configured with Pest PHP for unit and feature testing  

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| **Framework** | Laravel 12 |
| **Language** | PHP 8.2+ |
| **Database** | MySQL / SQLite |
| **ORM** | Eloquent |
| **API Security** | Laravel Sanctum |
| **Testing** | Pest PHP |
| **Build Tool** | Vite |

---

## Project Structure

```
Task-Manager/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── TasksController.php      # API controller for task operations
│   └── Models/
│       ├── Task.php                      # Task model with Eloquent ORM
│       └── User.php                      # User model for authentication
├── routes/
│   ├── api.php                           # API route definitions
│   ├── web.php                           # Web route definitions
│   └── console.php                       # Console command routes
├── database/
│   ├── migrations/                       # Database schema migrations
│   │   └── 2025_12_02_121641_create_tasks_table.php
│   ├── factories/                        # Model factories for testing
│   └── seeders/                          # Database seeders
├── config/                               # Application configuration files
├── resources/
│   ├── js/                               # JavaScript/Frontend assets
│   └── css/                              # Stylesheets
├── tests/                                # Unit and feature tests
├── public/                               # Public web root
├── storage/                              # File storage (logs, cache)
├── composer.json                         # PHP dependencies
├── package.json                          # Node.js dependencies
├── vite.config.js                        # Vite configuration
└── .env                                  # Environment configuration (create locally)
```

---

## Getting Started

### Prerequisites

Ensure you have the following installed on your system:

- **PHP 8.2 or higher** - [Download](https://www.php.net/downloads)
- **Composer** - [Download](https://getcomposer.org/download/)
- **Node.js & npm** - [Download](https://nodejs.org/)
- **MySQL 8.0+** or **SQLite** - [MySQL](https://www.mysql.com/downloads/) | [SQLite](https://www.sqlite.org/download.html)
- **Git** - [Download](https://git-scm.com/)

### Installation Steps

#### 1. Clone the Repository

```bash
git clone https://github.com/AfolJvsh/Modavcress.git
cd Task-Manager
```

#### 2. Install PHP Dependencies

```bash
composer install
```

#### 3. Install Node.js Dependencies

```bash
npm install
```

#### 4. Create Environment Configuration

Copy the example environment file and create your own:

```bash
copy .env.example .env
```

If `.env.example` doesn't exist, you can manually configure `.env` with:

```env
APP_NAME=TaskManager
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=

APP_KEY=
```

Generate application key:

```bash
php artisan key:generate
```

#### 5. Create the Database

Create a new MySQL database:

```sql
CREATE DATABASE task_manager;
```

Or if using SQLite, the database will be created automatically at `database/database.sqlite`.

#### 6. Run Database Migrations

Apply all database migrations to set up your schema:

```bash
php artisan migrate
```

This command will:
- Create the `users` table
- Create the `tasks` table with columns: id, title, status, timestamps
- Create the `cache`, `jobs`, and `personal_access_tokens` tables

#### 7. Start the Development Server

Open a terminal and start the Laravel development server:

```bash
php artisan serve
```

The API will be available at `http://localhost:8000`


```

---

## API Endpoints

All API endpoints are prefixed with `/api/tasks`

### Get All Tasks

**Request:**
```http
GET /api/tasks
```

**Response:**
```json
[
  {
    "id": 1,
    "title": "Complete project documentation",
    "status": "inprogress",
    "created_at": "2025-12-02T10:30:00.000000Z",
    "updated_at": "2025-12-02T11:45:00.000000Z"
  },
  {
    "id": 2,
    "title": "Review pull requests",
    "status": "todo",
    "created_at": "2025-12-02T09:15:00.000000Z",
    "updated_at": "2025-12-02T09:15:00.000000Z"
  }
]
```

### Create a New Task

**Request:**
```http
POST /api/tasks
Content-Type: application/json

{
  "title": "New task title",
  "status": "todo"
}
```

**Parameters:**
- `title` (required) - Task title, max 255 characters
- `status` (optional) - Task status: `todo`, `inprogress`, or `done`. Defaults to `todo`

**Response (201 Created):**
```json
{
  "id": 3,
  "title": "New task title",
  "status": "todo",
  "created_at": "2025-12-02T12:00:00.000000Z",
  "updated_at": "2025-12-02T12:00:00.000000Z"
}
```

### Update a Task

**Request:**
```http
PUT /api/tasks/{id}
Content-Type: application/json

{
  "title": "Updated task title",
  "status": "inprogress"
}
```

**Parameters:**
- `id` (required in URL) - The task ID to update
- `title` (optional) - Updated task title
- `status` (optional) - Updated status: `todo`, `inprogress`, or `done`

**Response (200 OK):**
```json
{
  "id": 1,
  "title": "Updated task title",
  "status": "inprogress",
  "created_at": "2025-12-02T10:30:00.000000Z",
  "updated_at": "2025-12-02T12:05:00.000000Z"
}
```

### Delete a Task

**Request:**
```http
DELETE /api/tasks/{id}
```

**Parameters:**
- `id` (required in URL) - The task ID to delete

**Response (204 No Content):**
```
(Empty response body)
```

### Health Check

**Request:**
```http
GET /api/
```

**Response:**
```
API is working
```

---

## Frontend Integration

This backend API is designed to work seamlessly with a **Next.js Task Manager frontend**. The frontend application communicates with this API using REST calls to manage tasks.

### Frontend-Backend Communication

The frontend makes HTTP requests to the Laravel API endpoints. Here's an example of how a Next.js component might interact with this API:

```javascript
// Example Next.js/React component
import axios from 'axios';
import { useEffect, useState } from 'react';

export default function TaskManager() {
  const [tasks, setTasks] = useState([]);
  const API_URL = 'http://localhost:8000/api/tasks';

  // Fetch all tasks
  useEffect(() => {
    axios.get(API_URL)
      .then(response => setTasks(response.data))
      .catch(error => console.error('Error fetching tasks:', error));
  }, []);

  // Create a new task
  const addTask = (title, status = 'todo') => {
    axios.post(API_URL, { title, status })
      .then(response => setTasks([...tasks, response.data]))
      .catch(error => console.error('Error creating task:', error));
  };

  // Update a task
  const updateTask = (id, updates) => {
    axios.put(`${API_URL}/${id}`, updates)
      .then(response => {
        setTasks(tasks.map(task => task.id === id ? response.data : task));
      })
      .catch(error => console.error('Error updating task:', error));
  };

  // Delete a task
  const deleteTask = (id) => {
    axios.delete(`${API_URL}/${id}`)
      .then(() => setTasks(tasks.filter(task => task.id !== id)))
      .catch(error => console.error('Error deleting task:', error));
  };

  return (
    <div>
      {/* Frontend UI components */}
    </div>
  );
}
```

### CORS Configuration

If your frontend runs on a different origin, ensure CORS is properly configured in Laravel. Update `config/cors.php` or add middleware to allow frontend requests.

### Environment Variables for Frontend

Your frontend should configure the API base URL:

```javascript
// Frontend .env
NEXT_PUBLIC_API_URL=http://localhost:8000/api
```

---

## Code Review Notes

### ✅ Strengths

1. **Clean Architecture** - Proper separation of concerns with dedicated Controllers and Models
2. **Input Validation** - All endpoints validate incoming data using Laravel's validation rules
3. **RESTful Design** - Endpoints follow REST conventions with appropriate HTTP methods and status codes
4. **Eloquent ORM** - Models leverage Eloquent for database interactions
5. **Type Hints** - Methods include return type declarations (JsonResponse)
6. **Mass Assignment Protection** - Models define `$fillable` properties for security


