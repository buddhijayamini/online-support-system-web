<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class TicketRepository.
 */
class TicketRepository implements TicketInterface
{
    public function getPaginated(): object
    {
      $ticket =  Ticket::with(['sender','receiver'])
                ->get();
                //   with(['sender' => function($query) {
                //     $query->where('id', '=', Auth::user()->id);
                // },'receiver'=> function($query) {
                //     $query->where('id', '=', Auth::user()->id);
                // }])
              //  ->paginate(10);

        return $ticket;
    }

    public function getById(int $TicketId)
    {
        return Ticket::find($TicketId);
    }

    public function store(array $TicketDetails): object
    {
        return Ticket::create($TicketDetails);
    }

    public function update(int $TicketId, array $newDetails) : bool
    {
        return Ticket::whereId($TicketId)->update($newDetails);
    }
}
