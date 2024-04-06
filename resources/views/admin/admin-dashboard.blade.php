@extends('admin.layout.admin-layout')
@section('content')
  <div class="main">
    <div class="content pt-6 w-[95%] mx-auto my-5 flex flex-col gap-11">
      <div class="dashboard w-full bg-gray-100 rounded-lg border border-gray-200 p-5 flex flex-col gap-6">
        <h1 class="text-2xl font-medium ">Dashboard</h1>
        <div class="cards grid grid-cols-4 gap-4">
          <div class="card bg-[#20A8D8] p-7 border border-[#177EA1] rounded-lg">
            <div class="number text-xl text-white font-medium">
              {{ $tickets->count() }}
            </div>
            <div class="text text-xl text-white font-medium">
              Total Tickets
            </div>
          </div>
          <div class="card bg-[#4DBD75] p-7 border border-[#389457] rounded-lg">
            <div class="number text-xl text-white font-medium">
              {{ $tickets->where('statut_id', 1)->count() }}
            </div>
            <div class="text text-xl text-white font-medium">
              Open Tickets
            </div>
          </div>
          <div class="card bg-[#F86C6B] p-7 border border-[#F6302E] rounded-lg">
            <div class="number text-xl text-white font-medium">
              {{ $tickets->where('statut_id', 2)->count() }}
            </div>
            <div class="text text-xl text-white font-medium">
              Closed Tickets
            </div>
          </div>
          <div class="card bg-[#F8991D] p-7 border border-[#795627] rounded-lg">
            <div class="number text-xl text-white font-medium">
              {{ $tickets->where('statut_id', 3)->count() }}
            </div>
            <div class="text text-xl text-white font-medium">
              Issued Tickets
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
              <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider">
                Operation
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
                  {{ $ticket->getStatut('status_id') }}
                </td>
                <td class="px-6 py-3 text-left text-xs font-medium border border-gray-400 tracking-wider">
                  {{ $ticket->getPriorite('priorite_id') }}
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
                <td class="px-6 py-3 text-center text-xs font-medium border border-gray-400 tracking-wider grid grid-cols-1 gap-1">
                  <a href="#" class="p-2 text-white text-xs font-medium bg-[#4280b7] rounded-lg">View</a>
                  <a href="#" class="p-2 text-white text-xs font-medium bg-[#4DA845] rounded-lg">Edit</a>
                  <a href="#" class="p-2 text-white text-xs font-medium bg-[#DC3544] rounded-lg">Delete</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
@endsection
