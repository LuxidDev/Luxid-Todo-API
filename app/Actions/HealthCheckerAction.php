<?php
namespace App\Actions;

use Luxid\Foundation\Action;
use Luxid\Http\Request;
use Luxid\Http\Response;

class HealthCheckerAction extends Action
{
    /**
     * Simple Health Checker Endpoint (Optional though)
     *
     * Get /api/health
     */
    public function index(Request $request, Response $response)
    {
        return $this->response()->json([
            'status' => 'healthy',
            'timestamp' => date('Y-m-d H:i:s'),
        ]);
    }
}
