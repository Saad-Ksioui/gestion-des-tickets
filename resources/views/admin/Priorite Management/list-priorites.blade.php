@extends('layout.admin-layout')
@section('content')
  @if (session()->has('success'))
    <div id="Alert" class="py-4 px-4 text-lg font-semibold text-white bg-green-600 absolute right-1 top-1 m-2">
      {{ session('success') }}
    </div>
  @endif
  @if (session()->has('warning'))
    <div id="Alert" class="py-4 px-4 text-lg font-semibold text-white bg-red-600 absolute right-1 top-1 m-2">
      {{ session('warning') }}
    </div>
  @endif
  <div class="list-priorites">
    <div class="content pt-6 w-[95%] mx-auto my-5 flex flex-col gap-11">
      <div class="lis-priorites w-full bg-gray-100 rounded-lg border border-gray-200 p-5 flex flex-col gap-6">
        <h1 class="text-2xl font-medium ">List Priorites</h1>
        <div>
          <a href="#" class="bg-blue-600 py-2 px-4 rounded-md text-white hover:shadow-md"
            id="openCreatePrioriteModalBtn">Add Priorite</a>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider">
                ID
              </th>
              <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider">
                Priorite Name
              </th>
              <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium border border-gray-400 uppercase tracking-wider">
                Operation
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($priorites as $priorite)
              <tr>
                <td class="px-6 py-3 text-left text-base font-medium border border-gray-400 tracking-wider">
                  {{ $priorite->id }}</td>
                <td class="px-6 py-3 text-left text-base font-medium border border-gray-400 tracking-wider">
                  {{ $priorite->nom }}</td>
                <td
                  class="px-6 py-3 text-base font-medium border border-gray-400 tracking-wider grid grid-cols-1 gap-2 text-center">
                  <a href="{{ route('edit-priorite', ['id'=>$priorite->id]) }}" class="text-white text-base font-medium bg-[#4DA845] rounded-lg py-1 edit-btn">Edit</a>
                  <form action="{{ route('delete-priorite', ['id'=>$priorite->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="text-white w-full py-1 text-base font-medium bg-[#DC3544] rounded-lg cursor-pointer"/>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- Create Priorite --}}
  <div id="createPrioritesModal" class="modal hidden fixed inset-0 z-50 overflow-hidden bg-gray-500 bg-opacity-50">
    <div class="modal-content relative bg-white shadow-md mx-auto my-20 w-96 p-6 rounded-lg">
      <span class="close text-3xl absolute top-0 right-0 mt-2 mr-4 text-gray-900 cursor-pointer">&times;</span>
      <h2 class="text-xl font-bold mb-4">Créer un nouveau priorite</h2>
      <form id="createPrioritesForm" action="{{ route('store-priorite') }}" method="POST">
        @csrf
        <div class="mb-4">
          <label for="nom" class="block mb-2 text-sm font-medium text-gray-900">Nom du priorite :</label>
          <input type="text" id="nom" name="nom"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5">
        </div>
        <button type="submit"
          class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">Créer</button>
      </form>
    </div>
  </div>
@endsection
