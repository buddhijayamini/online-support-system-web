<?php

namespace App\Repositories\Ticket;

interface TicketInterface
{
    public function getPaginated() : object;
    public function getById(int $TicketId);
    public function store(array $ticketDetails) : object;
    public function update(int $TicketId, array $newDetails) : bool;
}
