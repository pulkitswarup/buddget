<?php

namespace App\Http\Controllers;

use App\Group;
use App\Expense;
use App\Category;
use App\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExpenseRequest;

class ExpensesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $expenses = $user->expenses()->orderBy('purchased_at', 'desc')->paginate(env('DEFAULT_PAGE_SIZE'));
        return view('expenses.manage')->with('expenses', $expenses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user  = auth()->user();
        $groups = $user->groups()->pluck('name', 'groups.id')->prepend('No Group', -1);
        $categories = Category::orderBy('priority')->pluck('label', 'id');
        $currencies = Currency::orderBy('id')->pluck('symbol', 'id');
        return view('expenses.create')->with([
            "categories" => $categories, 
            "groups" => $groups,
            "currencies" => $currencies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseRequest $request)
    {
        $user = auth()->user();
        $expense = new Expense();
        $expense->item_name = $request->input('name');
        $expense->description = $request->input('description');
        $expense->amount = $request->input('amount'); // Store in integer format in the database
        $expense->category_id = $request->input('category');
        $expense->currency_id = $request->input('currency');
        $expense->group_id = ($request->input('group') != -1)?$request->input('group'):(Group::getDefaultGroupId($user));
        $expense->purchased_at = $request->input('purchased_date');
        $expense->save();

        return redirect(route('expenses.index'))->with('success', 'Successfully added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user  = auth()->user();
        $expense = $user->expenses()->findOrFail($id);

        $groups = $user->groups()->pluck('name', 'groups.id')->prepend('No Group', -1);
        $categories = Category::orderBy('priority')->pluck('label', 'id');
        $currencies = Currency::orderBy('id')->pluck('symbol', 'id');

        return view('expenses.edit')->with([
           'expense' => $expense, 
           'categories' => $categories,
           'currencies' => $currencies,
           'groups' => $groups
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreExpenseRequest $request, $id)
    {   
        $user  = auth()->user();
        $expense = $user->expenses()->findOrFail($id);
        $expense->item_name = $request->input('name');
        $expense->description = $request->input('description');
        $expense->amount = $request->input('amount');
        $expense->category_id = $request->input('category');
        $expense->currency_id = $request->input('currency');
        $expense->purchased_at = $request->input('purchased_date');
        $expense->group_id = ($request->input('group') != -1)?$request->input('group'):(Group::getDefaultGroupId($user));
        $expense->save();

        return redirect(route('expenses.index'))->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $expense = $user->expenses()->findOrFail($id);
        $expense->delete();

        return redirect(route('expenses.index'))->with('success', 'Successfully removed');
    }
}
