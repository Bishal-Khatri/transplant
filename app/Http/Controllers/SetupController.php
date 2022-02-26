<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class SetupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSetup()
    {
        return view('setup');
    }

    public function runSetup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50'
        ]);

        $message = '';
        $command = $request->name;
        switch ($command) {
            case "down":
                Artisan::call('down');
                $message = "Maintenance Mode";
                break;
            case "up":
                Artisan::call('up');
                $message = "Server Up";
                break;
            case "cache_clear":
                Artisan::call('cache:clear');
                $message = "Cache Cleared";
                break;
            case "view_clear":
                Artisan::call('view:clear');
                $message = "View Cleared";
                break;
            case "config_clear":
                Artisan::call('config:clear');
                $message = "Config Cleared";
                break;
            case "config_cache":
                Artisan::call('config:cache');
                $message = "Config Cached";
                break;

            case "migrate_refresh":
                Artisan::call('migrate:refresh');
                $message = "Migration Refreshed";
                break;

            case "migrate_fresh":
                Artisan::call('migrate:fresh');
                $message = "Fresh Migration";
                break;

            case "migrate_fresh_seed":
                Artisan::call('migrate:fresh --seed');
                $message = "Fresh Migration and DB Seed";
                break;

            case "migrate":
                Artisan::call('migrate');
                $message = "Database Migrated";
                break;

            case "db_seed":
                Artisan::call('db:seed');
                $message = "Database Seeded";
                break;

            case "storage_link":
                Artisan::call('storage:link');
                $message = "Storage Linked";
                break;
            default:
                echo "No action performed";
        }

        $returnData = [
            'error' => false,
            'message' => $message,
            'time' => Carbon::now()
        ];
        return response()->json($returnData, 200);
    }

}
