# Luxid Todo API – Test Endpoints Guide

## Starting the Server

First, let's start the server.

```bash
# Make sure you're in your Luxid project directory
php juice start
```

You should see:

```text
🚀 Starting Luxid development server...

🌐 Server running at: http://localhost:8000
📁 Serving from: /home/it_admin/software/PHP/LUXID/Luxid-Application/todo-api/web
🛑 Press Ctrl+C to stop

Starting PHP built-in server...
[Sun Jan 25 08:36:24 2026] PHP 8.3.29 Development Server (http://localhost:8000) started
```

---

## Postman Test Guide

### 1. GET `/api/todos` — List all todos

**Request**

```http
GET http://localhost:8000/api/todos
```

**Expected Response**

```json
{
  "success": true,
  "message": "Success",
  "data": {
    "todos": [],
    "count": 0,
    "meta": {
      "status_filter": null,
      "search_term": null
    }
  }
}
```

**With Query Parameters**

```http
GET http://localhost:8000/api/todos?status=pending&search=learn
```

---

### 2. POST `/api/todos` — Create a new todo

**Request**

```http
POST http://localhost:8000/api/todos
Content-Type: application/json
```

**Body (raw JSON)**

```json
{
  "title": "Learn Luxid Framework",
  "description": "Build a complete Todo API to understand how Luxid works",
  "status": "pending"
}
```

**Expected Response (201 Created)**

```json
{
  "success": true,
  "message": "Success",
  "data": {
    "todo": {
      "id": 1,
      "title": "Learn Luxid Framework",
      "description": "Build a complete Todo API to understand how Luxid works",
      "status": "pending",
      "created_at": "2024-01-15 10:30:00",
      "updated_at": "2024-01-15 10:30:00"
    },
    "message": "Todo created successfully"
  }
}
```

#### Create a few more todos for testing

**Todo 2**

```json
{
  "title": "Build Todo App",
  "description": "Create a frontend for the Todo API",
  "status": "in_progress"
}
```

**Todo 3**

```json
{
  "title": "Write Documentation",
  "description": "Document the Luxid framework features",
  "status": "pending"
}
```

**Todo 4**

```json
{
  "title": "Add Authentication",
  "description": "Implement JWT auth for the API",
  "status": "completed"
}
```

---

### 3. GET `/api/todos/{id}` — Get single todo

**Request**

```http
GET http://localhost:8000/api/todos/1
```

**Expected Response**

```json
{
  "success": true,
  "message": "Success",
  "data": {
    "todo": {
      "id": 1,
      "title": "Learn Luxid Framework",
      "description": "Build a complete Todo API to understand how Luxid works",
      "status": "pending",
      "created_at": "2026-01-25 16:24:46",
      "updated_at": "2026-01-25 16:24:46"
    }
  }
}
```

**Error Case (Non-existent ID)**

```http
GET http://localhost:8000/api/todos/999
```

**Expected Response (404)**

```json
{
  "success": false,
  "message": "Todo with ID 999 not found",
  "errors": null
}
```

---

### 4. PUT `/api/todos/{id}` — Update todo

**Request**

```http
PUT http://localhost:8000/api/todos/1
Content-Type: application/json
```

**Body**

```json
{
  "title": "Learn Luxid Framework - Updated",
  "status": "in_progress"
}
```

**Expected Response**

```json
{
  "success": true,
  "message": "Success",
  "data": {
    "todo": {
      "id": 1,
      "title": "Learn Luxid Framework - Updated",
      "description": "Build a complete Todo API to understand how Luxid works",
      "status": "in_progress",
      "created_at": "2024-01-15 10:30:00",
      "updated_at": "2024-01-15 10:35:00"
    },
    "message": "Todo updated successfully"
  }
}
```

#### Validation Error Test

```json
{
  "status": "invalid_status"
}
```

**Expected Response (422)**

```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "status": ["Status must be one of: pending, in_progress, completed"]
  }
}
```

---

### 5. DELETE `/api/todos/{id}` — Delete todo

**Request**

```http
DELETE http://localhost:8000/api/todos/4
```

**Expected Response**

```json
{
  "success": true,
  "message": "Success",
  "data": {
    "message": "Todo deleted successfully"
  }
}
```

---

### 6. PATCH `/api/todos/bulk-status` — Bulk update

**Request**

```http
PATCH http://localhost:8000/api/todos/bulk-status
Content-Type: application/json
```

**Body**

```json
{
  "todo_ids": [1, 2, 3],
  "status": "completed"
}
```

**Expected Response**

```json
{
  "success": true,
  "message": "Success",
  "data": {
    "message": "Updated 3 todos",
    "updated_count": 3
  }
}
```

---

### 7. GET `/api/health` — Health check

**Request**

```http
GET http://localhost:8000/api/health
```

**Expected Response**

```json
{
  "status": "healthy",
  "timestamp": "2024-01-15 10:40:00"
}
```

---

## Advanced Testing Scenarios

### Filtering with Query Parameters

```http
GET http://localhost:8000/api/todos?status=completed
GET http://localhost:8000/api/todos?search=Luxid
GET http://localhost:8000/api/todos?status=pending&search=documentation
```

### Testing Validation Rules

**Test 1: Title too short**

```json
{
  "title": "A",
  "description": "Test",
  "status": "pending"
}
```

**Test 2: Missing required field**

```json
{
  "description": "No title provided"
}
```

**Test 3: Description too long**

```json
{
  "title": "Valid Title",
  "description": "A".repeat(1000),
  "status": "pending"
}
```

---

### Testing Edge Cases

1. Empty Database: `GET /api/todos` should return an empty array
2. Invalid Route: `GET /api/nonexistent` should return **404**
3. Wrong Method: `POST` to a `GET` route should return **404**
4. Malformed JSON: Should be handled gracefully

---

## Postman Collection Setup

Create a new Postman collection called **"Luxid Todo API"** with the following folders:

### 1. Todo CRUD Operations

* Create Todo — `POST /api/todos`
* List Todos — `GET /api/todos`
* Get Single Todo — `GET /api/todos/{id}`
* Update Todo — `PUT /api/todos/{id}`
* Delete Todo — `DELETE /api/todos/{id}`

### 2. Bulk Operations

* Bulk Update Status — `PATCH /api/todos/bulk-status`

### 3. Utility Endpoints

* Health Check — `GET /api/health`
* API Docs — `GET /api/docs` (if implemented)

### 4. Filtering & Search

* Filter by Status — `GET /api/todos?status=completed`
* Search Todos — `GET /api/todos?search=learn`
* Combined Filter — `GET /api/todos?status=pending&search=work`
