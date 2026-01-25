# Juice CLI Commands Reference

## 🚀 Server Commands

### `php juice start`
Start the development server.
- **Options:**
  - `--host=HOST` - Server hostname (default: localhost)
  - `--port=PORT` - Server port (default: 8000)
- **Example:** `php juice start --host=127.0.0.1 --port=8080`

### `php juice fresh`
Fresh install - clears cache, runs migrations, and seeds database.
- **Use:** When setting up a new project or resetting everything

## 📊 Application Commands

### `php juice status`
Check application status and environment.
- **Shows:** PHP version, directories, routes count, migrations, environment status

### `php juice routes`
List all registered routes.
- **Shows:** Method, Path, Handler, Middleware for each route

### `php juice env:check`
Validate environment configuration.
- **Checks:** Required environment variables, .env file, database connection
- **Shows:** Passed checks, warnings, and errors

### `php juice version`
Show version information.
- **Shows:** Juice CLI version, Luxid Engine version, PHP version, OS info

## 🗄️ Database Commands

### `php juice db:create`
Create a new database based on .env configuration.
- **Requires:** DB_DSN, DB_USER, DB_PASSWORD in .env
- **Extracts:** Database name from DSN and creates it

### `php juice db:drop`
Drop the entire database (with confirmation).
- **Warning:** Destructive operation - asks for confirmation
- **Requires:** Database connection

### `php juice db:reset`
Reset database - drop and recreate.
- **Combines:** db:drop and db:create with confirmation

### `php juice db:status`
Show database status and tables.
- **Shows:** Database name, version, table list with row counts, recent migrations

### `php juice db:migrate`
Run database migrations.
- **Options:**
  - `--fresh` - Drop all tables and re-run migrations
- **Creates:** migrations table if not exists
- **Tracks:** Applied migrations

### `php juice db:rollback`
Rollback the last migration.
- **Options:**
  - `--step=N` - Rollback N migrations (default: 1)

### `php juice db:refresh`
Refresh database - rollback all and migrate again.
- **Equivalent:** `db:rollback --step=all` + `db:migrate`

## ⚡ Make Commands (Code Generation)

### `php juice make:action <name>`
Create a new Action class.
- **Arguments:** Action name (e.g., `TodoAction` or `Users/ListAction`)
- **Options:** `--force` - Overwrite if exists
- **Creates:** Action class in `app/Actions/`
- **Example:** `php juice make:action TodoAction`

### `php juice make:entity <name>`
Create a new Entity class.
- **Arguments:** Entity name (e.g., `User`)
- **Creates:** Entity class in `app/Entities/` with basic CRUD methods
- **Example:** `php juice make:entity User`

### `php juice make:middleware <name>`
Create a new Middleware class.
- **Arguments:** Middleware name (e.g., `AuthMiddleware`)
- **Creates:** Middleware class in `app/Middleware/`
- **Example:** `php juice make:middleware AuthMiddleware`

### `php juice make:migration <name>`
Create a new migration file.
- **Arguments:** Migration name (e.g., `create_users_table`, `add_email_to_users_table`)
- **Intelligent:** Creates appropriate template based on name
- **Creates:** Numbered migration file in `migrations/`
- **Example:** `php juice make:migration create_users_table`

### `php juice make:todo`
Create a complete TODO CRUD example.
- **Generates:** Entity, Action, Migration, Routes, and Seeder for Todo system
- **Perfect for:** Learning or starting a new feature
- **Creates:** Full working example with API endpoints

### `php juice make:api <resource>`
Generate a complete API CRUD for a resource.
- **Arguments:** Resource name (e.g., `Product`)
- **Generates:** Entity, Action, Migration, and Routes for the resource
- **Creates:** Complete REST API with CRUD operations
- **Example:** `php juice make:api Product`

## ❓ Help Commands

### `php juice help`
Show general help and command list.
- **Shows:** Available commands grouped by category
- **Usage:** `php juice help` or just `php juice`

### `php juice help <command>`
Show detailed help for a specific command.
- **Shows:** Command description, usage, options, and examples
- **Example:** `php juice help make:action`

## 📁 Directory Structure Created

When using Juice CLI, it creates/maintains this structure:

project/
├── app/
│   ├── Actions/          # Action classes
│   ├── Entities/         # Entity classes
│   └── Middleware/       # Middleware classes
├── config/              # Configuration files
├── migrations/          # Database migrations
├── routes/             # Route definitions
├── screens/             # frontend code
├── web/                # Public web files
└── .env                # Environment variables

## 🎯 Quick Start Examples

### Start a new project:
```bash
php juice fresh
php juice start


### Create a blog system:
```bash
php juice make:api Post
php juice make:api Comment
php juice db:migrate
php juice start

### Check everything is working:
```bash
php juice status
php juice env:check
php juice db:status
php juice routes

