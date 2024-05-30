<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface PostInterface
{
    public function listing($id = null);
    public function store(Request $request, $id = null);
    public function destroy($id);
}
