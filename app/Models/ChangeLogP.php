<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Controllers\ProjectChangeLog;
class ChangeLogP extends Model
{
    use HasFactory;
    protected $table = 'projects_changelog';
}
