<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Expenses;

class DashboardController extends Controller
{
    //
    public function index()
    {
        
        $currentUserId = Auth::user()->id;
        return view('home',compact('currentUserId'));
    }

    public function get_data($id)
    {
        $collectionExpenses = Expenses::with('expense_category')->where('user_id',$id)->groupBy('expense_category_id')->selectRaw('expense_category_id,sum(expenses.expense_value) as sum_per_category')->get();
        
        $data = [
            'data',
            'labels'
        ];

        foreach($collectionExpenses as $collectionExpense)
        {
            $colors = $this->random_color();
            $data['data'][] = $collectionExpense->sum_per_category;
            $data['labels'][] = $collectionExpense->expense_category->name;
            $data['backgroundColor'][] = '#'.$colors;
            $data['borderColor'][] = '#'.$colors;

        }

        return $data;
    }

    private function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    
    private function random_color() {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }
}
