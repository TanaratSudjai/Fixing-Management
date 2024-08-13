<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repir extends Model
{
    use HasFactory;
    // Specify the table associated with the model
    protected $table = 'repir';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'customer_id',
        'repair_detail',
        'employee_id',
        'product_id',
        'status_id',
    ];
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
