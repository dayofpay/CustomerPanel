<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
}