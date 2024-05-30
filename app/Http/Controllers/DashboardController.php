<?php

namespace App\Http\Controllers;

use App\Interfaces\PostInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected PostInterface $postInterface;

    public function __construct(PostInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }

    public function index()
    {
        $posts = $this->postInterface->listing()->get();

        return view("dashboard", compact(['posts']));
    }
}
