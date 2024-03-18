<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    use HasFactory;

    protected $table = 'user_actions';

    protected $fillable = ['user_id', 'action', 'action_id', 'type', 'ip', 'device'];

    public $timestamps = false;
}