<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Repositories\Ticket\TicketInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use DB;
use Exception;
use Validator;
use Illuminate\Support\Str;

class TicketController extends Controller
{

    protected $ticketInterface;

    public function __construct(TicketInterface $ticketInterface)
    {
        $this->ticketInterface = $ticketInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ticket = $this->ticketInterface->getPaginated();

        //only made sender as customer
        //only receiver as seller
        if ($request->ajax()) {

            return Datatables::of($ticket)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    if ($row->sender->id == Auth::user()->id) {
                        return $row->receiver->name;
                    } else if ($row->receiver->id == Auth::user()->id) {
                        return $row->sender->name;
                    } else {
                        return $row->sender->name;
                    }
                })
                ->addColumn('email', function ($row) {
                    if ($row->sender->id == Auth::user()->id) {
                        return $row->receiver->email;
                    } else if ($row->receiver->id == Auth::user()->id) {
                        return $row->sender->email;
                    } else {
                        return $row->sender->email;
                    }
                })
                ->addColumn('mobile', function ($row) {
                    if ($row->sender->id == Auth::user()->id) {
                        return $row->receiver->mobile;
                    } else if ($row->receiver->id == Auth::user()->id) {
                        return $row->sender->mobile;
                    } else {
                        return $row->sender->mobile;
                    }
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<label style="color:green"><b>Open</b></label>';
                    } else {
                        return '<label style="color:red;"><b>Close</b></label>';
                    }
                })
                ->addColumn('datetime', function ($row) {
                    return $row->created_at;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button"  class="btn btn-primary py-1 px-1 replybtn" data-bs-toggle="modal"
                    data-bs-target="#replyMdl" data-bs-toggle="dropdown"
                    aria-expanded="false" value = "' . $row->id . '">
                    <i class="fa fa-reply"></i> Reply</button>';
                    return $btn;
                })
                ->rawColumns(['name', 'email', 'mobile', 'status', 'datetime', 'action'])
                ->make(true);
        }

        return view('tickets/list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $validatedData["sender_id"] = Auth::user()->id;
            $validatedData["receiver_id"] = 2; // only make with 1 seller

            $random = Str::random(10);
            $validatedData["ref_no"]  = 'ref-' . $random;

            DB::beginTransaction();
            $data = $this->ticketInterface->store($validatedData);
            DB::commit();

            if ($data) {
                return response()->json(
                    [
                        'status' => 200,
                        'message' => "Create Ticket Successfully!"
                    ],
                );
            } else {
                return  response()->json(
                    [
                        'status' => 500,
                        'message' => "Create Ticket Error"
                    ],
                );
            }
        } catch (Exception $e) {
            return  response()->json(
                [
                    'status' => 500,
                    'message' => $e
                ],
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
