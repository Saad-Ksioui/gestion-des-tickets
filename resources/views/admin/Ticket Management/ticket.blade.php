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
  <div class="ticket">
    <div class="content pt-6 w-[95%] mx-auto my-5 flex flex-col gap-11">
      <div
        class="ticket w-full bg-gray-100 rounded-lg border border-gray-200 p-5 flex flex-col gap-6 h-[90%] overflow-y-scroll">
        <h1 class="text-2xl font-medium mb-5">Ticket</h1>
        <table class="min-w-full divide-y divide-gray-200">
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider bg-gray-50">
              ID
            </th>
            <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
              {{ $ticket->id }}
            </td>
          </tr>
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider bg-gray-50">
              Created at
            </th>
            <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
              {{ $ticket->created_at }}
            </td>
          </tr>
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider bg-gray-50">
              Sujet
            </th>
            <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
              {{ $ticket->sujet }}
            </td>
          </tr>
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider bg-gray-50">
              Description
            </th>
            <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
              {{ $ticket->description }}
            </td>
          </tr>
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider bg-gray-50">
              Statut
            </th>
            <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
              {{ $ticket->getStatut('statut_id') }}
            </td>
          </tr>
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider bg-gray-50">
              Priorite
            </th>
            <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
              {{ $ticket->getPriorite('priorite_id') }}
            </td>
          </tr>
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider bg-gray-50">
              Categorie
            </th>
            <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
              {{ $ticket->getCategorie('categorie_id') }}
            </td>
          </tr>
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider bg-gray-50">
              Author Name
            </th>
            <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
              {{ $ticket->getUser('user_id') }}
            </td>
          </tr>
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider bg-gray-50">
              Author Email
            </th>
            <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
              {{ $ticket->getUserEmail('user_id') }}
            </td>
          </tr>
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider bg-gray-50">
              Assigned to
            </th>
            <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
              {{ $ticket->getAssignedTo('assigned_to') }}
            </td>
          </tr>
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider bg-gray-50">
              Commentaires
            </th>
            <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
              @if ($commentaires->count() > 0)
                  @foreach ($commentaires as $commentaire)
                    <div class="bg-gray-100 p-4 rounded-lg">
                      <p class="text-gray-500 font-semibold uppercase">Par : {{ $commentaire->getUser('user_id') }} <span>({{ $commentaire->created_at }})</span></p>

                      <p class="text-gray-700">{{ $commentaire->commentaire }}</p>
                    </div>
                  @endforeach
              @else
                <p>Pas de commentaire</p>
              @endif
            </td>
          </tr>
        </table>

      </div>
    </div>
  </div>
@endsection
