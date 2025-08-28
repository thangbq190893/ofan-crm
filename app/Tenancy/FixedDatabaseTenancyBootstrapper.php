<?php

namespace App\Tenancy;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Bootstrappers\DatabaseTenancyBootstrapper;

class FixedDatabaseTenancyBootstrapper extends DatabaseTenancyBootstrapper
{
    public function initializeTenancy($tenant): void
    {
        // Nếu bật cờ DEV thì ép về DB cố định
        if (env('TENANCY_FIXED_DB', false)) {
            Config::set('database.connections.tenant.driver', env('DEV_TENANT_DB_CONNECTION', env('DB_CONNECTION','mysql')));
            Config::set('database.connections.tenant.host',   env('DEV_TENANT_DB_HOST', env('DB_HOST','118.27.202.139')));
            Config::set('database.connections.tenant.port',   env('DEV_TENANT_DB_PORT', env('DB_PORT','3306')));
            Config::set('database.connections.tenant.database', env('DEV_TENANT_DB_DATABASE', 'cp030657_ofan_crm'));
            Config::set('database.connections.tenant.username', env('DEV_TENANT_DB_USERNAME', env('DB_USERNAME','cp030657_ofan')));
            Config::set('database.connections.tenant.password', env('DEV_TENANT_DB_PASSWORD', env('DB_PASSWORD','ofan@123')));

            // Refresh connection
            DB::purge('tenant');
            DB::reconnect('tenant');
            return; // KHÔNG gọi parent() để tránh logic tạo DB theo id tenant
        }

        // PROD/STG: dùng hành vi mặc định (DB-per-tenant thật)
        parent::initializeTenancy($tenant);
    }
}
