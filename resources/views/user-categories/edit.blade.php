@extends('layout/main')
@section('main')
    <div>
        <p class="text-4xl">Add Categories</p>
    </div>
    <div class="mt-12">
        <div class="w-full bg-neutral-100 px-10 py-10 rounded-lg">
            <form action="{{ route('update-categories') }}" method="POST">
                {{ csrf_field() }}
                <div class="flex items-center">
                    <input type="checkbox"
                        class="cursor-pointer w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        id="visi_misi" name="visi_misi" value="3" {{(array_search(3, $data, true)) ? 'checked' : ''}}>
                    <label for="visi_misi" class="ml-2 font-medium">Visi dan Misi</label>
                </div>
                <div class="flex items-center mt-4">
                    <input type="checkbox"
                        class="cursor-pointer w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        id="kurikulum" name="kurikulum" value="5" {{(array_search(5, $data, true)) ? 'checked' : ''}}>
                    <label for="kurikulum" class="ml-2 font-medium">Kurikulum</label>
                </div>
                <div class="flex items-center mt-4">
                    <input type="checkbox"
                        class="cursor-pointer w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        id="jarak" name="jarak" value="1" {{(array_search(1, $data, true) == 0) ? 'checked' : ''}}>
                    <label for="jarak" class="ml-2 font-medium">Jarak</label>
                </div>
                <div class="flex items-center mt-4">
                    <input type="checkbox"
                        class="cursor-pointer w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        id="biaya_pembangunan" name="biaya_pembangunan" value="6" {{(array_search(6, $data, true)) ? 'checked' : ''}}>
                    <label for="biaya_pembangunan" class="ml-2 font-medium">Biaya Pembangunan</label>
                </div>
                <div class="flex items-center mt-4">
                    <input type="checkbox"
                        class="cursor-pointer w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        id="biaya_perbulan" name="biaya_perbulan" value="7" {{(array_search(7, $data, true)) ? 'checked' : ''}}>
                    <label for="biaya_perbulan" class="ml-2 font-medium">Biaya Perbulan</label>
                </div>
                <div class="flex items-center mt-4">
                    <input type="checkbox"
                        class="cursor-pointer w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        id="program_unggulan" name="program_unggulan" value="8" {{(array_search(8, $data, true)) ? 'checked' : ''}}>
                    <label for="program_unggulan" class="ml-2 font-medium">Program Unggulan</label>
                </div>
                <div class="flex items-center mt-4">
                    <input type="checkbox"
                        class="cursor-pointer w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        id="fasilitas" name="fasilitas" value="9" {{(array_search(9, $data, true)) ? 'checked' : ''}}>
                    <label for="fasilitas" class="ml-2 font-medium">Fasilitas</label>
                </div>
                <div class="flex items-center mt-4">
                    <input type="checkbox"
                        class="cursor-pointer w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        id="ekstrakurikuler" name="ekstrakurikuler" value="10" {{(array_search(10, $data, true)) ? 'checked' : ''}}>
                    <label for="ekstrakurikuler" class="ml-2 font-medium">Ekstrakurikuler</label>
                </div>
                <div class="flex items-center justify-between max-w-full">
                    <div></div>
                    <button type="submit"
                        class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-indigo-500 focus:outline-none focus:ring">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
