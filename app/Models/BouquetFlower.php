<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BouquetFlower extends Model
{
    protected $fillable = ['bouquet_id', 'flower_id', 'quantity'];
}