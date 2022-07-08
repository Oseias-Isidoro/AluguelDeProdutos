<?php

namespace App\Http\Controllers;

use App\Models\Rents;
use App\Services\RentService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        /** @noinspection PhpParamsInspection */
        $rents = (new RentService(Auth::user()))
            ->paginatedRentals(10);

        return view('home', compact('rents'));
    }
}
