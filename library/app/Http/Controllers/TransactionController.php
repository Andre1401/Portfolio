<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
        //pake can
        // if (auth()->user()->can('index transaction')) {
        //     $transactions = Transaction::get();

        //     $active = [];
        //     $nonActive = [];
        //     foreach ($trans as $tran) {
        //         if ($tran->status == 1) {
        //             $active[] = $tran->status;
        //         } else {
        //             $nonActive[] = $tran->status;
        //         }
        //     }

        //     $active = count($active);
        //     $nonActive = count($nonActive);
        
        //     return view('admin.transaction.index', compact('transactions','active','nonActive'));
        // } else {
        //     return abort('403');
        // }

        //pake role
        if (auth()->user()->role('index transaction')) {
            $transactions = Transaction::get();

            $active = [];
            $nonActive = [];
            foreach ($trans as $tran) {
                if ($tran->status == 1) {
                    $active[] = $tran->status;
                } else {
                    $nonActive[] = $tran->status;
                }
            }

            $active = count($active);
            $nonActive = count($nonActive);
        
            return view('admin.transaction.index', compact('transactions','active','nonActive'));
        } else {
            return abort('403');
        }
    }

    public function api()
    {
        if ($request->active == '0') {
            $datas = Transaction::with('firstMembers')->where('status', '=', $request->active)->get();
        } elseif ($request->active == '1') {
            $datas = Transaction::with('firstMembers')->where('status', '=', $request->active)->get();
        } elseif ($request->tanggals) {
            $datas = Transaction::with('firstMembers')->where('date_start', '=', $request->tanggals)->get();
        } else {
            $datas = Transaction::with('firstMembers')->get();
        }

        $dataTables = datatables()->of($datas)
            ->addColumn('nama_peminjam', function ($datas) {
                return $datas->firstMembers[0]->name;
            })
            ->addColumn('lama_peminjam', function ($datas) {
                $date_start =  $datas->date_start;
                $date_end =  $datas->date_end;

                $total_start = $date_start[8] . $date_start[9];
                $total_end = $date_end[8] . $date_end[9];

                $hari = $total_end - $total_start;
                return $hari . " Hari";
            })
            ->addColumn('total_buku', function ($datas) {
                $total_bukuu = $datas->transactiondetils;
                $total_buku = [];
                $total = [];
                foreach ($total_bukuu as $index => $unit) {
                    $total_buku[] = [
                        'qty' => $total_bukuu[$index]->qty
                    ];
                }
                return array_sum(array_column($total_buku, 'qty'));
            })
            ->addColumn('total_bayar', function ($datas) {
                $total_buku = [];
                foreach ($datas->transactiondetils as $tranDetail) {
                    $harga = $tranDetail->books->price;
                    $qty = $tranDetail->qty;
                    $total_buku[] = $harga * $qty;
                }
                $totalHarga = array_sum($total_buku);

                return array_sum($total_buku);
            })
            ->addColumn('action', function ($datas) {
                return '
                        <a href="' . url('transanctions/' . $datas->id . '/detail') . '" class="edit btn btn-primary btn-sm">Detail</a>
                        <a href="' . url('transanctions/' . $datas->id . '/edit') . '" class="edit btn btn-success btn-sm">Edit</a>
                        <form action="' . url('transanctions/' . $datas->id) . '" method="POST">
                     ' . csrf_field() . '
                    <input type="hidden" name="_method" value="DELETE" >
                    <button type="submit" class="edit btn btn-success btn-sm"
                        onclick="return confirm(\'Are You Sure Want to Delete?\')"
                        >X</a>
                    </form>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn();

        return $dataTables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'id' => "",
            'editStatus' => 'false'
        ];
        $members = Member::get();
        $books = Book::where('qty', '!=', 0)->get();
        return view('admin.transaction.create', compact('data', 'members', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'member_id' => ['required', 'min:1', 'max:30'],
            'date_start' => ['required'],
            'date_end' => ['required'],
            'buku' => ['required', 'min:1', 'max:300'],
        ]);

        $transaction = [
            'member_id' => $validate['member_id'],
            'date_start' => $validate['date_start'],
            'date_end' => $validate['date_end'],
            'status' => 1
        ];

        $dataTrans = Transaction::create($transaction);

        $buku = $request->buku;
        $total = [];
        foreach ($buku as $index => $unit) {
            $dataTransDetail = TransactionDetail::create([
                'transaction_id' => $dataTrans['id'],
                "book_id" => $buku[$index],
                'qty' => 1
            ]);
            $total = Book::find($buku[$index]);

            $updateBooks = Book::where('id', '=', $buku[$index])->update([
                'qty' =>  $total['qty'] - '1'
            ]);
        }

        // dd($dataTransDetail, $updateBooks, $total['qty'],  'created');
        return redirect('transanctions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $data = [
            'id' => $id,
            'editStatus' => 'true'
        ];

        $model = Transaction::find($id);
        $books = Book::where('qty', '!=', 0)->get();
        $id_member = Member::where('id', $model->member_id)->first();
        $members = Members::get();
        $trans = Transaction::with('member', 'transaction_details')->find($id);
        $details = TransactionDetail::where('transaction_id', '=', $id)->with('transaction', 'books')->get();

        // return $details;
        return view('admin.transaction.show', compact('trans', 'details', 'books', 'data', 'members', 'id_member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Transaction $transaction)
    {
        $data = [
            'id' => $id,
            'editStatus' => 'true'
        ];

        $model = Transaction::find($id);
        $books = Book::where('qty', '!=', 0)->get();
        $id_member = Member::where('id', $model->member_id)->first();
        $members = Member::get();
        $trans = Transaction::with('member', 'transactiondetails')->find($id);
        $details = TransactionDetail::where('transaction_id', '=', $id)->with('transaction', 'books')->get();


        // return $details;
        return view('admin.transaction.edit', compact('trans', 'details', 'books', 'data', 'members', 'id_member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update($id ,Request $request, Transaction $transaction)
    {
        $data = [
            'member_id' => $request->member_id,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'buku' => $request->buku,
            'status' => $request->status
        ];
        $trans = [
            'member_id' => $request->member_id,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'status' => '1'
        ];
        $datas = [];
        $status = $data['status'];
        if ($status == null) {
            $books = $data['buku'];
            if ($books == null) {
                $transaction = Transaction::where('id',  $id)->update($trans);
            } else {
                $bukuu = $request->buku;

                foreach ($bukuu as $buku) {
                    $bookss[] = [
                        'ids' => $buku,
                    ];
                    $getbook[] = [
                        'id' => TransactionDetail::where([
                            'transaction_id' => $id,
                            'book_id' => $buku
                        ])->get(),
                    ];
                    $datass = array_column($bookss, 'ids');
                    $datas = array_column($getbook, 'id');
                    $notNull = count($datas[0]);
                }
                $book_id = [];

                if ($notNull > 0) {
                    $datas = array_column($getbook, 'id');
                    foreach ($bukuu as $index => $unit) {
                        $idTrans = TransactionDetail::where([
                            'transaction_id' => $id,
                            "book_id" => $bukuu[$index],
                        ])->first();

                        $dataTransDetail = TransactionDetail::where([
                            'transaction_id' => $id,
                            "book_id" => $bukuu[$index],
                        ])->update([
                            'qty' => $idTrans['qty'] + 1
                        ]);
                        $total = Book::find($bukuu[$index]);

                        $updateBooks = Book::where('id', '=', $bukuu[$index])->update([
                            'qty' =>  $total['qty'] - '1'
                        ]);
                    }
                } else {
                    foreach ($bukuu as $index => $unit) {

                        $dataTransDetail = TransactionDetail::create([
                            'transaction_id' => $id,
                            "book_id" => $bukuu[$index],
                            'qty' => 1
                        ]);
                        $total = Book::find($bukuu[$index]);

                        $updateBooks = Book::where('id', '=', $bukuu[$index])->update([
                            'qty' =>  $total['qty'] - '1'
                        ]);
                    }
                }
                $return = [
                    'detail' => $datas,

                ];
            }
        } else {

            $transactionActive = TransactionDetail::where([
                'transaction_id' => $id,
            ])->with('books')->get();

            $getBook = [];
            $getQtyBook = [];
            $getQtyDetail = [];

            foreach ($transactionActive as $trans) {
                $getBook[] = $trans->books->id;
                $getQtyBook[] = $trans->books->qty;
                $getQtyDetail[] = $trans->qty;
            }
            foreach ($getBook as $index => $unit) {
                foreach ($getQtyBook as $index => $unit) {
                    foreach ($getQtyDetail as $index => $unit) {
                        Book::where('id', '=', $getBook[$index])->update([
                            'qty' =>  $getQtyBook[$index] + $getQtyDetail[$index]
                        ]);
                    }
                }
            }


            $trans = [
                'status' => $request->status
            ];
            Transaction::where('id', $id)->update($trans);
        }
        return redirect('transanctions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Transaction $transaction)
    {
        $transaction->where('id', '=', $id)->delete();
        return redirect('transanctions');
    }
}
