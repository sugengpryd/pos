<div class="w-full p-4 mx-auto">
    <div class="flex flex-col md:flex-row">
        <div class=" flex-1 justify-start items-start top-1 text-lg p-2 text-gray-700 text-bold">
             <h3>Delivery History</h3>
        </div>
        <div class="flex flex-col md:flex-row items-start justify-between md:items-end gap-4">
            <input
            wire:model="FilterSearch"
            type="text"
            placeholder=" Search.."
            class="rounded-lg shadow-lg"
            >
            <select
            class="rounded-lg"
            >
            <option value="">Filter Date</option>
            <option></option>
            </select>

        </div>
    </div>
    <div class="w-full max-w-[full] top-0  min-h-screen mx-auto mt-2 justify-start overflow-auto bg-slate-600">

        <div class="flex flex-row justify-start items-center p-2 ">
            <table class="w-full flex-col border-collapse bg-white">
                <thead class="bg-gray-400 text-white z-50 sticky top-0">
                    <tr>
                        <th class="p-4 w-14">id</th>
                        <th class="p-4 w-14">Batch Id</th>
                        <th class="p-4 w-14">From</th>
                        <th class="p-4 w-14">Alamat</th>
                        <th class="p-4 w-14">To</th>
                        <th class="p-4 w-14">Alamat Tujuan</th>
                        <th class="p-4 w-14">No tujuan</th>
                        <th class="p-4 w-14">Biaya Kirim</th>
                        <th class="p-4 w-14">Flaq</th>
                        <th class="p-4 w-14">Created At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-400 bg-white">
                    @foreach ($result as $index => $results )
                    <tr>
                        <td
                        class="sticky py-3 px-3 w-14 text-xs font-semibold text-center">
                        {{$index+1}}
                        </td>
                        <td
                        class="sticky py-3 px-3 w-14 text-xs font-semibold text-center">
                        {{$results->batch_Id}}
                        </td>
                        <td
                        class="sticky py-3 px-3 w-14 text-xs font-semibold text-left">
                        {{$results->fromName}}
                        </td>
                        <td
                        class="sticky py-3 px-3 w-14 text-xs font-semibold text-center">
                        {{$results->fromAlamat}}
                        </td>
                        <td
                        class="sticky py-3 px-3 w-14 text-xs font-semibold text-center">
                        {{$results->toName}}
                        </td>
                        <td
                        class="sticky py-3 px-3 w-14 text-xs font-semibold text-center">
                        {{$results->toAlamat}}
                        </td>
                        <td
                        class="sticky py-3 px-3 w-14 text-xs font-semibold text-center">
                        {{$results->toNumber}}
                        </td>
                        <td
                        class="sticky py-3 px-3 w-14 text-xs font-semibold text-center">
                        {{$results->BiayaKirim}}
                        </td>
                        <td
                        class="sticky py-3 px-3 w-14 text-xs font-semibold text-center">
                        {{$results->flaq}}
                        </td>
                        <td
                        class="sticky py-3 px-3 w-14 text-xs font-semibold text-center">
                        {{$results->created_at}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
