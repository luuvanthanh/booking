<?php

namespace App\Http\Controllers;

use App\Http\Services\searchService;
use App\Models\Department;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(searchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function searchUser($value)
    {
        $users = $this->searchService->searchUser($value);

        return $users;
    }

    public function searchRoom($value)
    {
        $rooms = $this->searchService->searchRoom($value);

        return $rooms;
    }

    public function searchDepartment($value)
    {
        $departments = $this->searchService->searchDepartment($value);

        return $departments;
    }
}
