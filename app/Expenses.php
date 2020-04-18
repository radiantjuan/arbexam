<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    //
    public function expense_category()
    {
        return $this->hasOne(ExpensesCategory::class,'id','expense_category_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
