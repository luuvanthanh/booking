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

    public function searchUser($searchVl)
    {
        $users = $this->searchService->searchUser($searchVl);

        return $users;
    }

    public function searchRoom($searchVl) {
        $rooms = $this->searchService->searchRoom($searchVl);

        return $rooms;
    }

    public function searchDepartment($searchVl) {
        $departments = $this->searchService->searchDepartment($searchVl);

        return $departments;
    }
}
