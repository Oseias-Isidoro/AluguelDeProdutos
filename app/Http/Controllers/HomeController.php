<?php

namespace App\Http\Controllers;

use App\Services\RentService;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $rents = (new RentService())
            ->paginatedRentals(10);

        return view('home', compact('rents'));
    }
}
