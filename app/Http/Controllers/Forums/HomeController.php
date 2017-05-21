<?php

namespace App\Http\Controllers\Forums;

use App\Models\Forums\ForumSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {
        $forumsSections = ForumSection::all();
        return view('forums.forums', ['forumsSections' => $forumsSections]);
    }
}
