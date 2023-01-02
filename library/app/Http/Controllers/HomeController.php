<?php 

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\Transaction;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Book;
use App\Models\Member;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
    	$book_total = Book::count();
    	$member_total = Member::count();
    	$publisher_total = Publisher::count();
    	$transaction_total = Transaction::whereMonth('date_start', date('m'))->count();

    	$data_donut = Book::select(DB::raw("COUNT(publisher_id) as total"))->groupBy('publisher_id')->orderBy('publisher_id','asc')->pluck('total');
    	$label_donut = Publisher::orderBy('publishers.id', 'asc')->join('books','books.publisher_id','=','publishers.id')->groupBy('publishers.name')->pluck('publishers.name');

    	$label_bar = ['Borrow', 'Return'];
    	$data_bar = [];

    	foreach ($label_bar as $key => $value) {
    		$data_bar[$key]['label'] = $label_bar[$key];
    		$data_bar[$key]['backgroundColor'] = $key == 0 ? 'rgba(60,141,188,0.9)' : 'rgba(210,214,222,1)';
    		$data_month = [];

    		foreach (range(1,12) as $month) {
    			if ($key == 0) {
    				$data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_start', $month)->first()->total;
    			}else {
    				$data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_end', $month)->first()->total;
    			}
    		}

    		$data_bar[$key]['data'] = $data_month;
    	}

        return view('dashboard', compact('book_total','member_total','publisher_total','transaction_total','data_donut','label_donut', 'data_bar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}