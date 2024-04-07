@extends('layout.admin-layout')
@section('content')
  <div class="main">
    <div class="content pt-6 w-[95%] mx-auto my-5 flex flex-col gap-11">
      <div class="profileInfo w-full bg-gray-100 rounded-lg border border-gray-200 p-5 flex flex-col gap-6">
        <h1 class="text-xl font-medium">Profile Information</h1>
        <p class="text-sm">Update your account's profile information and email adresse</p>
        <form action="" method="POST">
          @csrf
          @method('put')
          <div class="mb-3">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
            <input type="text" name="nom_complet" id="name" value="{{ $currentUser->nom_complet }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5"/>
          </div class="mb-3">
          <div class="mb-3">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
            <input type="text" name="email" id="email" value="{{ $currentUser->email }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5"/>
          </div>
          <button type="submit"
            class="text-white bg-gray-800 hover:bg-gray-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Save
          </button>
        </form>
      </div>
      <div class="updatePassword w-full bg-gray-100 rounded-lg border border-gray-200 p-5 flex flex-col gap-6">
        <h1 class="text-xl font-medium ">Update Password</h1>
        <p class="text-sm">Ensure to use a long, random password</p>
        <form action="" method="POST">
          @csrf
          @method('put')
          <div class="mb-3">
            <label for="currentpassword" class="block mb-2 text-sm font-medium text-gray-900">Current Password</label>
            <input type="text" name="currentpassword" id="currentpassword"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5"/>
          </div class="mb-3">
          <div class="mb-3">
            <label for="newpassword" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
            <input type="text" name="newpassword" id="newpassword"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5"/>
          </div class="mb-3">
          <div class="mb-3">
            <label for="confirmpassword" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
            <input type="text" name="confirmpassword" id="confirmpassword"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5"/>
          </div class="mb-3">
          <button type="submit"
            class="text-white bg-gray-800 hover:bg-gray-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Save
          </button>
        </form>
      </div>
      <div class="deleteAccount w-full bg-gray-100 rounded-lg border border-gray-200 p-5 flex flex-col gap-6">
        <h1 class="text-xl font-medium ">Delete Account</h1>
        <p class="text-sm">Once your account is deleted, all of your data will be deleted</p>
        <form action="" method="POST">
          @csrf
          @method('delete')
          <input type="submit" value="Delete Account" class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center uppercase cursor-pointer">
        </form>
      </div>
    </div>
  </div>
@endsection
