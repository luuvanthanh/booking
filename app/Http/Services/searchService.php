<?php

namespace App\Http\Services;

use App\Models\Department;
use App\Models\Room;
use App\Models\User;

class searchService 
{
    public function searchUser($searchVl)
    {
        $users = User::with('department')->where('name', 'like', '%' . $searchVl . '%')->orWhere('email', 'like', '%' . $searchVl . '%')->paginate(config('app.paginate_user'));
        echo '<table class="table">';
            echo '<thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Adress</th>
                <th scope="col">Phone</th>
                <th scope="col">Department</th>
                <th scope="col" colspan="3"></th>
            </tr>
            </thead>';
        echo '<tbody>';
     foreach($users as $user) {
        echo '<tr>
            <th scope="row">'. $user->id .'</th>
            <td>'. $user->name .'</td>
            <td>'. $user->email .'</td>
            <td>'. $user->address .'</td>
            <td>'. $user->phone .'</td>
            
            <td>'. $user->department->name .'</td>
            <td class="text-center">
                <a class="btn btn-primary btn-sm" href="/user/create">
                    <i class="fas fa-plus-square"></i>
                </a>
            </td>
            <td class="text-center">
                <a class="btn btn-dark btn-sm" href="/user/edit/'. $user->id.'">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td class="text-center">
                <form action="/user/destroy/'. $user->id.'" method="POST">
                <meta name="csrf-token" content="'. csrf_token(). ' }}">
                <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
          </tr>';
        }
        echo '</tbody>';
        echo  '</table>';
    }

    public function searchRoom($searchVl)
    {
        $rooms = Room::where('roomNumber', 'like', '%' . $searchVl . '%')->orWhere('people', 'like', '%' . $searchVl . '%')->paginate(config('app.paginate_room'));

        echo '<table class="table">';
        echo '<thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">RoomNumber</th>
                <th scope="col">People</th>
                <th scope="col">Avatar</th>
                <th scope="col" colspan="3"></th>
            </tr>
            </thead>';
        echo '<tbody>';
            foreach($rooms as $room)
            { 
                echo '<tr>
                    <th scope="row">'. $room->id.'</th>
                    <td>'.$room->roomNumber.'</td>
                    <td>'.$room->people.'</td>
                    <td style="width: 100px;"><img src="'.$room->avatar.'" style="width: 100%;" alt=""></td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm" href="/user/create">
                            <i class="fas fa-plus-square"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-dark btn-sm" href=/room/edit/'. $room->id.'">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <form action="/room/destroy/'. $room->id.'" method="POST">
                        <meta name="csrf-token" content="'. csrf_token(). ' }}">
                        <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>';
            }
        echo '</tbody>';
        echo '</table>';
    }

    public function searchDepartment($searchVl)
    {
        $departments = Department::where('name', 'like', '%' .$searchVl. '%')->paginate(config('app.paginate_department'));

        echo '<table class="table">';
        echo '<thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Name</th>
                <th scope="col" colspan="3"></th>
            </tr>
            </thead>';
        echo '<tbody>';
            foreach($departments as $department)
            { 
                echo '<tr>
                    <th scope="row">'. $department->id.'</th>
                    <td>'.$department->name.'</td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm" href="/department/create">
                            <i class="fas fa-plus-square"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-dark btn-sm" href=/department/edit/'. $department->id.'">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <form action="/department/destroy/'. $department->id.'" method="POST">
                        <meta name="csrf-token" content="'. csrf_token(). ' }}">
                        <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>';
            }
        echo '</tbody>';
        echo '</table>';
    }
}