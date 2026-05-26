<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DiagnosticsController extends Controller
{
    public function index()
    {
        // 1. Check database connection
        $dbStatus = 'Unknown';
        $dbError = null;
        try {
            DB::connection()->getPdo();
            $dbStatus = 'Connected';
        } catch (\Exception $e) {
            $dbStatus = 'Disconnected';
            $dbError = $e->getMessage();
        }

        // 2. Git Information
        $gitBranch = trim(@shell_exec('git rev-parse --abbrev-ref HEAD') ?? 'main');
        $commitHash = trim(@shell_exec('git log -1 --format="%H"') ?? '');
        $commitHashShort = trim(@shell_exec('git log -1 --format="%h"') ?? 'N/A');
        $commitMessage = trim(@shell_exec('git log -1 --format="%s"') ?? 'No commit information found');
        $commitAuthor = trim(@shell_exec('git log -1 --format="%an"') ?? 'PaaS Deployer');
        $commitDate = trim(@shell_exec('git log -1 --format="%ad"') ?? date('Y-m-d H:i:s'));
        
        // Dynamic fallback if no real git logs are available in the container
        if ($commitHashShort === 'N/A') {
            $commitHashShort = substr(md5_file(base_path('composer.json')), 0, 7);
            $commitHash = md5_file(base_path('composer.json'));
        }

        // 3. System Metrics
        $phpVersion = PHP_VERSION;
        $laravelVersion = app()->version();
        $osType = PHP_OS;
        
        // Disk Space
        $diskFree = @disk_free_space(base_path()) ?: 0;
        $diskTotal = @disk_total_space(base_path()) ?: 1;
        $diskUsed = $diskTotal - $diskFree;
        $diskPercent = round(($diskUsed / $diskTotal) * 100, 2);
        
        $diskFreeHuman = $this->formatBytes($diskFree);
        $diskTotalHuman = $this->formatBytes($diskTotal);

        // Deployed env vars (non-sensitive)
        $envInfo = [
            'APP_NAME' => config('app.name'),
            'APP_ENV' => config('app.env'),
            'APP_DEBUG' => config('app.debug') ? 'true' : 'false',
            'APP_URL' => config('app.url'),
            'DB_CONNECTION' => config('database.default'),
        ];

        return view('diagnostics.index', compact(
            'dbStatus', 'dbError', 'gitBranch', 'commitHash', 
            'commitHashShort', 'commitMessage', 'commitAuthor', 
            'commitDate', 'phpVersion', 'laravelVersion', 'osType', 
            'diskPercent', 'diskFreeHuman', 'diskTotalHuman', 'envInfo'
        ));
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
