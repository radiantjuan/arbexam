<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesCategory extends Model
{
    //
    public function expenses()
    {
        return $this->hasMany(Expenses::class, "id","expense_category_id");
    }
}
