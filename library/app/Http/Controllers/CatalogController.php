<?php

namespace App\Http\Controllers;

// use App\Models\TransactionDetail;
// use App\Models\Transaction;
// use App\Models\Author;
// use App\Models\Publisher;
// use App\Models\Book;
// use App\Models\Member;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
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
        //$members = Member::with('user')->get();
        //$books = Book::with('catalog')->get();
        //$publishers = Publisher::with('books')->get();
        //$author = Author::with('books')->get();
        //$catalog = Catalog::with('books')->get();

        //Querry Builder
        // No 1
        // $data = Member::select('*')->join('users','users.member_id','=','members.id')->get();

        // //No 2
        // $data2 = Member::select('*')->leftjoin('users','users.member_id','=','members.id')->where('users.id', NULL)->get();

        // //No 3
        // $data3 = Transaction::select('members.id','members.name')->rightjoin('members', 'members.id', '=', 'transactions.member_id')->where('transactions.member_id', NULL)->get();

        // //No 4
        // $data4 = Member::select('members.id','members.name','members.phone_number')->join('transactions','transactions.member_id','=','members.id')->orderBy('members.id','asc')->get();

        // //No 5
        // $data5 = Member::select('members.id', 'members.name', 'members.phone_number')->join('transactions', 'transactions.member_id', '=', 'members.id')->where('transactions.member_id', '>', 1)->get();

        // //No 6
        // $data6 = Member::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')->join('transactions','transactions.member_id','=','members.id')->get();

        // //No 7
        // $month = '06';
        // $data7 = Member::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')->join('transactions','transactions.member_id','=','members.id')->whereMonth('transactions.date_end', '=', $month)->get();

        // //No 8
        // $month = '05';
        // $data8 = Member::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')->join('transactions','transactions.member_id','=','members.id')->whereMonth('transactions.date_start', '=', $month)->get();

        // //No 9
        // $month = '06';
        // $data9 = Member::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')->join('transactions','transactions.member_id','=','members.id')->whereMonth('transactions.date_end', '=', $month)->whereMonth('transactions.date_start', '=', $month)->get();

        // //No 10
        // $data10 = Member::select('members.name','members.phone_number','members.address','transactions.date_start','transactions.date_end')->join('transactions','transactions.member_id','=','members.id')->where('members.address', '=', 'Bandung')->get();

        // //No 11
        // $data11 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'members.gender',  'transactions.date_start', 'transactions.date_end')->join('transactions','transactions.member_id','=','members.id')->where('members.address', '=', 'Bandung')->where('members.gender', '=', 'W')->get();

        // //No 12
        // $data12 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'members.gender',  'transactions.date_start', 'transaction_details.qty')->join('transactions','transactions.member_id','=','members.id')->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')->where('transaction_details.qty', '>', '1')->get();

        // //No 13
        // $count = DB::raw('transaction_details.qty * books.price as total_price');
        // $data13 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'members.gender',  'transactions.date_start', 'transactions.date_end', 'transaction_details.qty as qty_trans', 'books.id as id_book', 'books.title', 'books.price as harga_pinjam', $count)->join('transactions', 'transactions.member_id', '=', 'members.id')->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')->join('books', 'transaction_details.book_id', '=', 'books.id')->get();

        // //No 14
        // $data14 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address', 'members.gender',  'transactions.date_start', 'transactions.date_end', 'transaction_details.qty', 'books.title',  'publishers.name as name_penerbit', 'authors.name as name_pengarang', 'catalogs.name as name_catalog')->join('transactions', 'transactions.member_id', '=', 'members.id')->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')->join('books', 'transaction_details.book_id', '=', 'books.id')->join('catalogs', 'books.catalog_id', '=', 'catalogs.id')->join('authors', 'books.author_id', '=', 'authors.id')->join('publishers', 'books.publisher_id', '=', 'publishers.id')->get();

        // //No 15
        // $data15 =Book::select('catalogs.id','catalogs.name','books.title')->join('catalogs','catalogs.id','=','books.catalog_id')->get();

        // //No 16
        // $data16 = Book::select('books.*','publishers.name')->leftjoin('publishers','publishers.id', '=', 'books.publisher_id')->get();

        // //No 17
        // $count = DB::raw('SUM(books.author_id = 1) as total_author_id_1');
        // $data17 = Book::select('books.author_id', $count)->groupBy('books.author_id')->get();

        // //No 18
        // $data18 = Book::select('*')->where('price','>','10000')->get();

        // //No 19
        // $data19 = Book::select('books.*','publishers.name')->join('publishers','publishers.id','=','books.publisher_id')->where('publishers.id','=','1')->where('books.qty','>','10')->get();

        // //No 20
        // $data20 = Member::select('*')->whereMonth('created_at','06');

        // return $data20;

        $catalogs = Catalog::with('books')->get();

        // return $catalogs;
        return view('admin.catalog.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catalog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['name' => ['required'] ]);

        //1
        // $catalog = new Catalog;
        // $catalog->name = $request->name;
        // $catalog->save();

        //2
        Catalog::create($request->all());

        return redirect('catalogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $catalog)
    {
        return view('admin.catalog.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalog $catalog)
    {
        $this->validate($request,['name' => ['required'] ]);

        $catalog->update($request->all());

        return redirect('catalogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();

        return redirect('catalogs');
    }
}
