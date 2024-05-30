<?php

namespace App\Models;

use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";
    protected $guarded = [];

    public function save(array $options = array())
    {
        if (!isset($this->id)) {
            $this->user_id = loggedUserID();
        }
        parent::save($options);
    }
}
