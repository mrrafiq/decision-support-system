@extends('layout.main')
@section('main')
    <div>
        <p class="text-4xl">Tambahkan Detail Profil Sekolah</p>
    </div>
    <div class="mt-12">
        <form action="{{ url('school/store-detail/' .$data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="description" class="font-semibold">Deskripsi</label>
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl mt-4">
                <textarea id="description" class="pl-2 w-full outline-none border-none" type="text" name="deskripsi"
                    placeholder="Tuliskan sesuatu......." required rows="10"></textarea>
            </div>
            <label for="vision" class="font-semibold">Visi</label>
            <div
                class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl mt-4">
                <textarea id="vision" class=" pl-2 w-full outline-none border-none" type="text" name="visi"
                    placeholder="Visi" required rows="5"></textarea>
            </div>
            <label for="mission" class="font-semibold">Misi</label>
            <div
                class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl mt-4">
                <textarea id="mission" class=" pl-2 w-full outline-none border-none" type="text" name="misi"
                    placeholder="Misi" required rows="5"></textarea>
            </div>
            <label for="curriculum" class="font-semibold">Kurikulum</label>
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl mt-4">
                <select name="kurikulum" id="curriculum" class="pl-2 w-full outline-none border-none bg-transparent" required>
                    <option selected>Pilih kurikulum</option>
                    <option value="kemenag">Kementerian Agama</option>
                    <option value="kemendikbud">Kementerian Pendidikan dan Kebudayaan</option>
                    <option value="mandiri">Mandiri</option>
                    <option value="kemenag_mandiri">Kementerian Agama dan Mandiri</option>
                    <option value="kemendikbud_mandiri">Kementerian Pendidikan dan Kebudayaan dan Mandiri</option>
                </select>
            </div>
            <label for="entry" class="font-semibold">Biaya Pembangunan</label>
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl mt-4">
                <input id="entry" class=" pl-2 w-full outline-none border-none" type="text" name="biaya_pembangunan"
                    placeholder="contoh: 5000000" required />
            </div>
            <label for="monthly" class="font-semibold">Biaya Per-bulan</label>
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl mt-4">
                <input id="monthly" class=" pl-2 w-full outline-none border-none" type="text" name="biaya_perbulan"
                    placeholder="contoh: 5000000" required />
            </div>
            <label for="program" class="font-semibold">Program Unggulan</label>
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl mt-4">
                <input id="program" class=" pl-2 w-full outline-none border-none" type="text" name="program_unggulan" placeholder="Tahfiz, Peternakan,..."
                    required />
            </div>
            <label for="facility" class="font-semibold">Fasilitas</label>
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl mt-4">
                <input id="facility" class=" pl-2 w-full outline-none border-none" type="text" name="fasilitas"
                    placeholder="Laundry, Makan harian,...." required />
            </div>
            <label for="extracurricular" class="font-semibold">Ekstrakurikuler</label>
            <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl mt-4">
                <textarea id="extracurricular" class=" pl-2 w-full outline-none border-none" name="ekstrakurikuler"
                    placeholder="ekstrakurikuler" required rows="5"></textarea>
            </div>
            <div class="flex items-center justify-between">
                <div></div>
                <button type="submit"
                    class=" px-3 py-2 text-sm font-medium text-white transition bg-sky-500 rounded hover:scale-110 hover:shadow-xl active:bg-indigo-500 focus:outline-none focus:ring mb-6">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
