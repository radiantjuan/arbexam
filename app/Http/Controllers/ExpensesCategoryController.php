<?php

namespace App\Http\Controllers;

use App\Expenses;
use App\ExpensesCategory;
use Illuminate\Http\Request;
use App\User;
class ExpensesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!User::userCan(['browse_expenses_category']))
        {
            abort(404);
        }

        $canEdit = User::userCan(['edit_expenses_category']);
        $canAdd = User::userCan(['add_expenses_category']);
        $canDelete = User::userCan(['delete_expenses_category']);

        $expenseCategories = ExpensesCategory::all();
        return view('expenses-category.index',compact('expenseCategories','canEdit','canAdd','canDelete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!User::userCan(['add_expenses_category']))
        {
            abort(404);
        }

        return view('expenses-category.create');
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
            'name' => 'required'
        ]);

        $expenseCategories = new ExpensesCategory;
        $expenseCategories->name = $request->name;
        $expenseCategories->save();
        return redirect(route('expenses-category.edit',['expenses_category' => $expenseCategories->id]))->with('status','Saved!');
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
    public function edit($id)
    {
        $category = ExpensesCategory::find($id);
        return view('expenses-category.edit',compact('category'));
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
        //
        $category = ExpensesCategory::find($id);
        $category->name = $request->name;
        $category->update();
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
        $expenses = Expenses::where('expense_category_id',$id)->delete();
        $expenseCategories = ExpensesCategory::find($id)->delete();
        return back()->with('status','Deleted!');
    }

    public function get_affected_expenses($id)
    {
        $expenseCategories = Expenses::where('expense_category_id',$id)->get();
        return $expenseCategories;
    }
}
