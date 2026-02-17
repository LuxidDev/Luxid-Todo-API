<?php
namespace App\Actions;

use App\Actions\LuxidAction;
use Luxid\Nodes\Response;

class HealthCheckerAction extends LuxidAction
{
    /**
     * Simple Health Checker Endpoint (Optional though)
     *
     * Get /api/health
     */
    public function index()
    {
        return Response::json([
            'status' => 'healthy',
            'timestamp' => date('Y-m-d H:i:s'),
        ]);
    }
}
