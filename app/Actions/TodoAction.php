<?php
namespace App\Actions;

use App\Entities\Todo;
use App\Actions\LuxidAction;
use Luxid\Http\Request;
use Luxid\Http\Response;

class TodoAction extends LuxidAction
{
    /**
     * Get all todos (with optional filtering).
     * GET /api/todos
     */
    public function index(Request $request, Response $response)
    {
        // Use query() for query parameters
        $status = $request->query('status');
        $search = $request->query('search');

        // Build where conditions
        $where = [];
        if ($status && in_array($status, ['pending', 'in_progress', 'completed'])) {
            $where['status'] = $status;
        }

        // Get todos from database
        $todos = Todo::findAll($where, 'created_at DESC');

        // Search in results
        if ($search) {
            $todos = array_filter($todos, function($todo) use ($search) {
                return stripos($todo->title, $search) !== false ||
                       stripos($todo->description, $search) !== false;
            });
            $todos = array_values($todos);
        }

        // Format for JSON response
        $data = array_map(function ($todo) {
            return $todo->toArray();
        }, $todos);

        // Use response() helper to get Response instance
        return $response->success([
            'todos' => $data,
            'count' => count($data),
            'meta' => [
                'status_filter' => $status,
                'search_term' => $search
            ]
        ]);
    }

    /**
     * Get single todo by ID
     * GET /api/todos/{id}
     */
    public function show(Response $response, $id)
    {
        // Find the todo using Active Record's find method
        $todo = Todo::find($id);

        if (!$todo) {
            return $response->error("Todo with ID $id not found", null, 404);
        }

        return $response->success([
            'todo' => $todo->toArray()
        ]);
    }

    /**
     * Create new todo
     * POST /api/todos
     */
    public function store(Request $request, Response $response)
    {
        // Use input() for POST body data
        $data = $request->input();

        // Create new Todo entity
        $todo = new Todo();
        $todo->loadData($data);

        // Validate and save
        if ($todo->validate() && $todo->save()) {
            return $response->success([
                'todo' => $todo->toArray(),
                'message' => 'Todo created successfully'
            ], 201);
        }

        // Return validation errors
        return $response->error('Validation failed', $todo->errors, 422);
    }

    /**
     * Update todo
     * PUT /api/todos/{id}
     */
    public function update(Request $request, Response $response, $id)
    {
        // Find the todo
        $todo = Todo::find($id);

        if (!$todo) {
            return $response->error("Todo with ID $id not found", null, 404);
        }

        // Use input() for PUT body data (better than getBody())
        $data = $request->input();

        // Update the entity
        $todo->loadData($data);

        if ($todo->validate() && $todo->update()) {
            return $response->success([
                'todo' => $todo->toArray(),
                'message' => 'Todo updated successfully'
            ]);
        }

        return $response->error('Validation failed', $todo->errors, 422);
    }

    /**
     * Delete todo
     * DELETE /api/todos/{id}
     */
    public function destroy(Request $request, Response $response, $id)
    {
        // Find the todo
        $todo = Todo::find($id);

        if (!$todo) {
            return $response->error("Todo with ID $id not found", null, 404);
        }

        if ($todo->delete()) {
            return $response->success([
                'message' => 'Todo deleted successfully'
            ]);
        }

        return $response->error('Failed to delete todo', null, 500);
    }

    /**
     * Bulk update status
     * PATCH /api/todos/bulk-status
     */
    public function bulkUpdateStatus(Request $request, Response $response)
    {
        // Use input() for PATCH body data
        $data = $request->input();

        if (!isset($data['todo_ids']) || !is_array($data['todo_ids']) || !isset($data['status'])) {
            return $response->error('Missing todo_ids array or status', null, 400);
        }

        $status = $data['status'];
        if (!in_array($status, ['pending', 'in_progress', 'completed'])) {
            return $response->error('Invalid status value', null, 400);
        }

        $updatedCount = 0;
        foreach ($data['todo_ids'] as $id) {
            $todo = Todo::find($id);
            if ($todo) {
                $todo->status = $status;
                if ($todo->update()) {
                    $updatedCount++;
                }
            }
        }

        return $response->success([
            'message' => "Updated {$updatedCount} todos",
            'updated_count' => $updatedCount
        ]);
    }
}
