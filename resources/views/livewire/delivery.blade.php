<div class="w-full py-4">
    <div class="w-full h-[90vh]">
        <div class="w-full flex flex-col justify-center items-center  min-w-[1080px] px-8" >
            <table class="w-full flex-col justify-center items-center border-collapse bg-white">
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
                <tbody>
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
                        class="sticky py-3 px-3 w-14 text-xs font-semibold text-center">
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
