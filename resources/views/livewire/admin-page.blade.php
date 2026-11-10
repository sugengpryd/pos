<div class="py-2">
    <div class="w-full h-screen p-2 ">
        <div class=" bg-slate-700 flex flex-col md:flex-row justify-center items-center px-2 overflow-hidden">

            <div class="bg-transparent md:flex-col flex flex-row p-4">
                    <button
                    type="button"
                    wire:click="btnDatabaseUpdate"
                    class="bg-lime-300 w-auto p-2 px-4 rounded-lg text-xs"


                    >Customer List</button>
            </div>

            <div class="bg-transparent md:flex-col flex flex-row p-2">
                     <button
                    type="button"
                    {{-- wire:click="btnDatabaseUpdate" --}}
                    wire:click="btnCustomer"
                    class="bg-lime-300 w-auto p-2 px-4 rounded-lg text-xs"


                    >Database Update</button>

            </div>
            <div class="bg-transparent md:flex-col flex flex-row p-2">
                    <span class="bg-lime-300 w-auto p-2 px-4 rounded-lg text-xs">Database list</span>

            </div>
            <div class="bg-transparent md:flex-col flex flex-row p-2">
                    <span class="bg-lime-300 w-auto p-2 px-4 rounded-lg text-xs">User Admin</span>

            </div>
            @if (session()->has('success'))
            <div
                 x-data="{ show: true }"
                 x-init="setTimeout(() => show = false, 3000)"
                 x-show="show"
                 x-transition
                  class="bg-green-500 text-white p-3 rounded"
                >
                 {{ session('success') }}
            </div>
            @endif
        </div>




        @if($showCustomer)
        <div class="fixed flex flex-col inset-0 w-full h-screen items-center z-999999 md:mt-20 justify-center bg-black bg-opacity-50 overflow-auto">

            <div class="w-full h-screen bg-gray-300 rounded-lg justify-center items-center shadow-lg px-2">
                <div class="text-lg text-white">Customer List</div>

                <form>
                {{-- <div class="flex-1 min-h-0 w-full overflow-auto overscroll-contain"> --}}
                    <table class="w-full justify-start items-start border-collapse border bg-white ">
                        <thead class="bg-gray-400 p-4">
                            <tr>
                            <th class="p-2">id</th>
                            <th class="p-2">users_id</th>
                            <th class="p-2">name</th>
                            <th class="p-2">email</th>
                            <th class="p-2">email_verified_at</th>
                            {{-- <th class="p-2">password</th> --}}
                            {{-- <th class="p-2">remember_token</th> --}}
                            <th class="p-2">dbconnection</th>
                            <th class="p-2">dbcreated</th>
                            <th class="p-2">Notification Update</th>
                            <th class="p-2">created_at</th>
                            <th class="p-2">updated_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userList as $index =>$users )

                            <tr>

                                <td class="p-2 text-xs border-b text-wrap border-b-slate-600" >{{$index+1}}</td>
                                <td class="p-2 text-xs border-b text-wrap border-b-slate-600" >{{$users->id}}</td>
                                <td class="p-2 text-xs border-b text-wrap border-b-slate-600" >{{ $users->name }}</td>
                                <td class="p-2 text-xs border-b text-wrap border-b-slate-600" >{{ $users->email }}</td>
                                <td class="p-2 text-xs border-b text-wrap border-b-slate-600" >{{ $users->email_verified_at }}</td>
                                {{-- <td class="p-2 text-xs" >{{ $users->password }}</td> --}}
                                {{-- <td class="p-2 text-xs border-b text-wrap border-b-slate-600" >{{ $users->remember_token }}</td> --}}
                                <td class="p-2 text-xs border-b text-wrap border-b-slate-600" >{{ $users->dbconnection }}</td>
                                <td class="p-2 text-xs border-b text-wrap border-b-slate-600" >{{ $users->dbcreated }}</td>
                                <td class="p-2 text-xs border-b text-wrap border-b-slate-600 text-center"                                >
                                <button
                                    type="button"
                                    wire:click="btnupdateFlaq('{{ $users->id }}', '{{ $users->updateFlaq }}')"
                                    wire:loading.attr="disabled"
                                    wire:target="btnupdateFlaq"
                                    class="bg-yellow-400 p-2 rounded"
                                >
                                    {{ $updateFlaq[$users->id] ?? $users->updateFlaq }}
                                </button>
                                </td>
                                <td class="p-2 text-xs border-b border-b-slate-600" >{{ $users->created_at }}</td>
                                <td class="p-2 text-xs border-b border-b-slate-600" >{{ $users->updated_at }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                {{-- </div> --}}
                 </form>

            </div>

        </div>

        @endif

        @if($DatabaseUpdate)
        <div class="fixed inset-0 z-50 w-full h-auto mt-20 items-center justify-center bg-black bg-opacity-50">

            <div class=" flex flex-col max-w-[full] bg-transparent rounded-lg justify-center items-center shadow-lg p-6 max-h-screen overflow-auto ">
                <div class="text-lg text-white">Database Update</div>

            <form>
                <div class="flex flex-row justify-end items-end mb-2">
                                <button
                                    type="button"
                                    wire:click="DataUpdate('alluser')"
                                    class="bg-red-700 rounded-lg p-2 shadow-lg  text-white shadow-white justify-end items-end"
                                    >Update All
                                </button>
                </div>
                    <table class="w-full border-collapse border mx-auto bg-white  ">

                        <thead class="bg-gray-400 p-4">


                            <th class="p-2 ">id</th>
                            <th class="p-2 ">users_id</th>
                            <th class="p-2 ">db_name</th>
                            <th class="p-2 ">size</th>
                            <th class="p-2 ">path</th>
                            <th class="p-2 ">flaq</th>
                            <th class="p-2 ">created_at</th>
                            <th class="p-2 ">updated_at</th>
                            <th class="p-2 ">action</th>

                        </thead>
                        <tbody>
                            @foreach ($dbcreateds as $index =>$dbcreated )

                            <tr>

                                <td class="p-2 text-xs border-b border-b-slate-600" >{{$index+1}}</td>
                                <td class="p-2 text-xs border-b border-b-slate-600" >{{$dbcreated->users_id}}</td>
                                <td class="p-2 text-xs border-b border-b-slate-600" >{{ $dbcreated->db_name }}</td>
                                <td class="p-2 text-xs border-b border-b-slate-600" >{{ $dbcreated->size }}</td>
                                <td class="p-2 text-xs border-b border-b-slate-600" >{{ $dbcreated->path }}</td>
                                <td class="p-2 text-xs border-b border-b-slate-600" >{{ $dbcreated->flaq }}</td>
                                <td class="p-2 text-xs border-b border-b-slate-600" >{{ $dbcreated->dbcreated }}</td>
                                <td class="p-2 text-xs border-b border-b-slate-600" >{{ $dbcreated->updated_at }}</td>
                                <td class="p-2 text-xs" >
                                <button
                                    type="button"
                                    wire:click="DataUpdate('{{$dbcreated->users_id}}')"
                                    class="bg-gray-400 p-2 shadow-lg shadow-black"
                                    >
                                    Update User
                                </button>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
            </form>
            </div>

        </div>

        @endif
        </div>
</div>
