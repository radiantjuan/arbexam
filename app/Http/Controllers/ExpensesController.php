<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;
use App\Permission;
use App\User;
use App\Expenses;
use App\ExpensesCategory;
use Illuminate\Support\Facades\Auth;


class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // check if admin
        $user = Auth::user();
        $role = Roles::find($user->role_id);
        if($role->name == 'Admin')
        {
            $canBrowse = User::userCan(['browse_expenses_category']);
            $expensesUsers = Expenses::with('user')->groupBy('user_id')->selectRaw('user_id,sum(expenses.expense_value) as sum_per_user')->get();

            $user = User::all();
            $arrData = [];
            foreach($expensesUsers as $expenses)
            {
                $arrData[$expenses->user_id] = [
                    'id' => $expenses->user_id,
                    'name' => $expenses->user->name,
                    'sum_per_user' => $expenses->sum_per_user
                ];
            }

            foreach($user as $us)
            {
                if(!in_array($us->id,array_keys($arrData)))
                {
                    $arrData[$us->id] = [
                        'id' => $us->id,
                        'name' => $us->name,
                        'sum_per_user' => 0
                    ];
                }
            }

            return view('expenses.index-admin',compact('arrData','canBrowse'));
        }
        else
        {
            return redirect(route('expenses.user',['user' => $user->id]));
        }
        // $expenses = Expenses::where('user_id');
        
    }

    public function user_expenses($id)
    {
            $canBrowse = User::userCan(['browse_expenses']);
            if(!$canBrowse)
            {
                abort(404);
            }
            $isAdmin = User::isAdmin($id);
            $expensesUsers = Expenses::with('expense_category')->where('user_id',$id)->groupBy('expense_category_id')->selectRaw('expense_category_id,sum(expenses.expense_value) as sum_per_category')->get();
            $expensesCategory = ExpensesCategory::all();
            
            $arrData = [];
            foreach($expensesUsers as $expenses)
            {
                $arrData[$expenses->expense_category_id] = [
                    'id' => $expenses->expense_category_id,
                    'name' => $expenses->expense_category->name,
                    'sum_per_category' => $expenses->sum_per_category
                ];
            }

            foreach($expensesCategory as $cat)
            {
                if(!in_array($cat->id,array_keys($arrData)))
                {
                    $arrData[$cat->id] = [
                        'id' => $cat->id,
                        'name' => $cat->name,
                        'sum_per_category' => 0
                    ];
                }
                
            }
        
            $objUser = User::find($id);
            return view('expenses.user-expenses',compact('arrData','objUser','isAdmin'));
    }

    public function category_expenses($user,$category)
    {
        $canBrowse = User::userCan(['browse_expenses']);
        if(!$canBrowse)
        {
            abort(404);
        }
        $isAdmin = User::isAdmin($user);
        $expenses = Expenses::where('user_id',$user)->where('expense_category_id',$category)->get();
        $categories = ExpensesCategory::find($category);
        $objUser = User::find($user);
        $canUserEdit = User::userCan(['edit_expenses']);
        $canUserDelete = User::userCan(['delete_expenses']);
        $canUserAdd = User::userCan(['add_expenses']);
        return view('expenses.index',compact('expenses','categories','objUser','canUserEdit','canUserDelete','canUserAdd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if(!User::userCan(['add_expenses']))
        {
            abort(404);
        }

        $userId = $request->user;
        $categoryId = $request->category;
        $objCategory = ExpensesCategory::find($request->category);
        return view('expenses.create',compact('expense','categoryId','userId','objCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'expense_value' => 'required'
        ]);

        $expense = new Expenses;
        $expense->name=$request->name;
        $expense->expense_value = $request->expense_value;
        $expense->user_id =  $request->user;
        $expense->expense_category_id = $request->category;
        $expense->save();

        return redirect(route('expenses.edit',['expense' => $expense->id,'category'=>$request->category,'user'=>$request->user]))->with('status','Saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
        if(!User::userCan(['edit_expenses']))
        {
            abort(404);
        }
        $userId = $request->user;        
        $expense = Expenses::find($id);
        $isAdmin = User::isAdmin($expense->user_id);
        $categoryId = $request->category;
        return view('expenses.edit',compact('expense','categoryId','userId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'expense_value' => 'required'
        ]);

        //
        $expense = Expenses::find($id);
        $expense->name=$request->name;
        $expense->expense_value = $request->expense_value;
        $expense->user_id = $request->user;
        $expense->expense_category_id = $request->category;
        $expense->update();

        return back()->with('status','Saved!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $expense = Expenses::find($id);
        $expense->delete();
        return back()->with('status','Saved!');
    }
}
