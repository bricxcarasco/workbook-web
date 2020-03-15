<?php

namespace App\Http\Controllers\Tables;

use App\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationsController extends Controller
{
    public function viewDetailEmployment(Request $request, $employment)
    {
        $application = json_decode($employment, true);

        $information = new Application;

        if ($application['type'] == 1) {
            $information = Application::where('applications.id', $application['id'])
            ->leftJoin('regular_listings', 'applications.job_id', '=', 'regular_listings.id')
            ->leftJoin('seekers', 'applications.seeker_id', '=', 'seekers.id')
            ->leftJoin('users', 'regular_listings.user_id', '=', 'users.id')
            ->leftJoin('providers', 'users.id', '=', 'providers.user_id')
            ->select('applications.*', 'seekers.*', 'providers.*', 'regular_listings.*')->first();
        } else {
            $information = Application::where('applications.id', $application['id'])
            ->leftJoin('quick_listings', 'applications.job_id', '=', 'quick_listings.id')
            ->leftJoin('seekers', 'applications.seeker_id', '=', 'seekers.id')
            ->leftJoin('users', 'quick_listings.user_id', '=', 'users.id')
            ->leftJoin('providers', 'users.id', '=', 'providers.user_id')
            ->select('applications.*', 'seekers.*', 'providers.*', 'quick_listings.*')->first();
        }

        return $information;
    }
}
