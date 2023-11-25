<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          {{-- コメントアウト:ここから

            <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>created at</th>
                <th>update at</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <th scope="row">{{ ++$loop->index }}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->created_at }}</td>
          <td>{{ $user->update_at }}</td>
          </tr>
          @endforeach
          </tbody>
          </table>

          {{$users->links()}}

          コメントアウト:ここまで--}}

          <!-- ★YajraDBを用いる場合のコード★-->
          {{ $dataTable->table() }}

        </div>
      </div>
    </div>
  </div>

  <!-- $dataTableをロードしている -->
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
</x-app-layout>