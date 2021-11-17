<?php
namespace App\Repositories\Booking;

use App\Repositories\RepositoryInterface;

interface BookingRepositoryInterface extends RepositoryInterface
{
    public function bookRoom(array $attributes);

    public function checkRoom($idRoom, $date);
}