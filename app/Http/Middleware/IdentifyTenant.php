<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class IdentifyTenant
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();
        $tenant = Tenant::where('domain', $host)->first();
        if (!$tenant) {
            abort(404, 'Tenant not found');
        }
        config(['database.connections.tenant.database' => $tenant->database]);
        DB::setDefaultConnection('tenant');
        // You may set tenant in service container
        app()->instance(Tenant::class, $tenant);
        return $next($request);
    }
}
