@php
  $statutColor = [
      'Open' => ['bg-[#4DBD75]', 'text-[#256B3D]'],
      'In Progress' => ['bg-[#20A8D8]', 'text-[#0F4C75]'],
      'Closed' => ['bg-[#F86C6B]', 'text-[#92231A]'],
      'Issued' => ['bg-[#F8991D]', 'text-[#5E4B15]'],
  ];

  $prioriteColor = [
      'High' => ['bg-[#F86C6B]', 'text-[#92231A]'],
      'Medium' => ['bg-[#F8991D]', 'text-[#5E4B15]'],
      'Low' => ['bg-[#20A8D8]', 'text-[#0F4C75]'],
  ];

@endphp
@extends('layout.admin-layout')
@section('content')
  <div class="main">
    <div class="content pt-6 w-[95%] mx-auto my-5 flex flex-col gap-11">
      <div class="dashboard w-full bg-gray-100 rounded-lg border border-gray-200 p-5 flex flex-col gap-6">
        <h1 class="text-2xl font-medium ">Dashboard</h1>
        <div class="cards grid grid-cols-4 gap-4">

          <div class="card bg-[#4DBD75] p-7 border border-[#389457] rounded-lg">
            <div class="number text-xl text-white font-medium">
              {{ $tickets->where('statut_id', 1)->count() }}
            </div>
            <div class="text text-xl text-white font-medium">
              {{ $statuts->where('id', 1)->first()->nom }} Tickets
            </div>
          </div>
          <div class="card bg-[#20A8D8] p-7 border border-[#177EA1] rounded-lg">
            <div class="number text-xl text-white font-medium">
              {{ $tickets->where('statut_id', 2)->count() }}
            </div>
            <div class="text text-xl text-white font-medium">
              {{ $statuts->where('id', 2)->first()->nom }} Tickets
            </div>
          </div>
          <div class="card bg-[#F86C6B] p-7 border border-[#F6302E] rounded-lg">
            <div class="number text-xl text-white font-medium">
              {{ $tickets->where('statut_id', 3)->count() }}
            </div>
            <div class="text text-xl text-white font-medium">
              {{ $statuts->where('id', 3)->first()->nom }} Tickets
            </div>
          </div>
          <div class="card bg-[#F8991D] p-7 border border-[#795627] rounded-lg">
            <div class="number text-xl text-white font-medium">
              {{ $tickets->where('statut_id', 4)->count() }}
            </div>
            <div class="text text-xl text-white font-medium">
              {{ $statuts->where('id', 4)->first()->nom }} Tickets
            </div>
          </div>
        </div>
      </div>
      <div class="recent-tickets w-full bg-gray-100 rounded-lg border border-gray-200 p-5 flex flex-col gap-6">
        <h1 class="text-2xl font-medium">Recent Tickets</h1>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider">
                Subject
              </th>
              <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider">
                Description
              </th>
              <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider">
                Status
              </th>
              <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider">
                Priority
              </th>
              <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider">
                Category
              </th>
              <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider">
                Employee Name
              </th>
              <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider">
                Employee Email
              </th>
              <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider">
                Assigned To
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tickets->take(3) as $ticket)
              <tr>
                <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
                  <a href="#" class="hover:underline">
                    {{ Str::limit($ticket->sujet, 15) }}
                  </a>
                </td>
                <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
                  <a href="#" class="hover:underline">
                    {{ Str::limit($ticket->description, 20) }}
                  </a>
                </td>
                <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
                  <span></span><span
                    class="{{ isset($statutColor[$ticket->getStatut('status_id')])
                        ? $statutColor[$ticket->getStatut('status_id')][0] .
                            ' ' .
                            $statutColor[$ticket->getStatut('status_id')][1] .
                            ' rounded-lg px-2 py-1 font-semibold'
                        : '' }}">
                    {{ $ticket->getStatut('status_id') }}
                  </span>
                </td>
                <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
                  <span
                    class="{{ isset($prioriteColor[$ticket->getPriorite('priorite_id')])
                        ? $prioriteColor[$ticket->getPriorite('priorite_id')][0] .
                            ' ' .
                            $prioriteColor[$ticket->getPriorite('priorite_id')][1] .
                            ' rounded-lg px-2 py-1 font-semibold'
                        : '' }}">
                    {{ $ticket->getPriorite('priorite_id') }}
                  </span>

                </td>
                <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
                  {{ $ticket->getCategorie('categorie_id') }}
                </td>
                <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
                  {{ $ticket->getUser('user_id') }}
                </td>
                <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
                  {{ $ticket->getUserEmail('user_id') }}
                </td>
                <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
                  {{ $ticket->assigned_to }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="flex justify-end mt-2">
          <a href="#" class="py-2 px-4 bg-black text-white font-medium rounded-md hover:shadow-md">Show all</a>
        </div>
      </div>
    </div>
  </div>
@endsection
