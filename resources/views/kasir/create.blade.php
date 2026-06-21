<x-app-layout>
    <div class="mb-6">
        <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold flex items-center gap-3">
                        <i class="fas fa-cash-register"></i>
                        Mesin Kasir
                    </h1>

                    <p class="mt-2 text-indigo-100">
                        Cabang :
                        <span class="font-semibold">
                            {{ auth()->user()->cabang->nama ?? 'Pusat' }}
                        </span>
                    </p>
                </div>

                <div class="hidden md:block text-right">
                    <p class="text-sm text-indigo-100">
                        {{ now()->format('d M Y') }}
                    </p>

                    <p class="text-xl font-bold">
                        {{ now()->format('H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
            <i class="fas fa-times-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- LIST BARANG --}}
        <div class="xl:col-span-1 bg-white rounded-2xl shadow-sm border border-gray-100">

            <div class="p-5 border-b">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-box-open text-indigo-500"></i>
                    Pilih Barang
                </h3>

                <div class="mt-4">
                    <input
                        type="text"
                        id="searchBarang"
                        placeholder="Cari barang..."
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>
            </div>

            <div class="p-4 max-h-[600px] overflow-y-auto space-y-3" id="listBarang">

                @foreach($stoks as $stok)
                    <div class="barang-item bg-gray-50 hover:bg-indigo-50 border border-gray-200 rounded-xl p-4 transition">

                        <div class="flex justify-between items-start">

                            <div>
                                <h4 class="font-semibold text-gray-800 text-sm">
                                    {{ $stok->barang->nama }}
                                </h4>

                                <div class="mt-2 flex items-center gap-2">
                                    <span class="text-xs px-2 py-1 rounded-full
                                        {{ $stok->quantity < 10
                                            ? 'bg-red-100 text-red-600'
                                            : 'bg-green-100 text-green-600' }}">
                                        Stok: {{ $stok->quantity }}
                                    </span>
                                </div>

                                <p class="mt-3 text-lg font-bold text-indigo-600">
                                    Rp {{ number_format($stok->barang->harga,0,',','.') }}
                                </p>
                            </div>

                            <button
                                type="button"
                                onclick="tambahKeKeranjang(
                                    {{ $stok->barang->id }},
                                    `{{ $stok->barang->nama }}`,
                                    {{ $stok->barang->harga ?? 0 }},
                                    {{ $stok->quantity }}
                                )"
                                class="bg-indigo-600 text-white px-3 py-2 rounded-lg hover:bg-indigo-700 text-xs font-bold"
                            >
                                <i class="fas fa-plus"></i>
                            </button>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        {{-- KERANJANG --}}
        <div class="xl:col-span-2">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-full flex flex-col">

                <div class="p-5 border-b flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-shopping-cart text-green-500"></i>
                            Keranjang Belanja
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Total Item :
                            <span id="jumlahItem" class="font-semibold">0</span>
                        </p>
                    </div>
                </div>

                <form
                    action="{{ route('transaksi.store') }}"
                    method="POST"
                    id="formTransaksi"
                    class="flex flex-col flex-1"
                >
                    @csrf

                    <div class="flex-1 p-5">

                        <div
                            id="keranjangArea"
                            class="border rounded-xl overflow-hidden"
                        >

                            <div
                                id="keranjangKosong"
                                class="text-center py-20 text-gray-400"
                            >
                                <i class="fas fa-shopping-basket text-5xl mb-4"></i>

                                <p>
                                    Belum ada barang dipilih
                                </p>
                            </div>

                            <table
                                id="tabelKeranjang"
                                class="w-full hidden"
                            >
                                <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                                    <tr>
                                        <th class="px-4 py-3 text-left">Barang</th>
                                        <th class="px-4 py-3">Qty</th>
                                        <th class="px-4 py-3 text-right">Subtotal</th>
                                        <th class="px-4 py-3 text-center">#</th>
                                    </tr>
                                </thead>

                                <tbody id="isiKeranjang"></tbody>
                            </table>

                        </div>
                    </div>

                    <div class="border-t bg-gray-50 p-5">

                        <div class="bg-white border rounded-xl p-5 mb-4">

                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">
                                    Total Pembayaran
                                </span>

                                <span
                                    id="tampilanTotal"
                                    class="text-4xl font-extrabold text-green-600"
                                >
                                    Rp 0
                                </span>
                            </div>

                            <input
                                type="hidden"
                                name="total_harga"
                                id="inputTotalHarga"
                                value="0"
                            >
                        </div>

                        <button
                            type="submit"
                            id="btnSimpan"
                            disabled
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <i class="fas fa-print mr-2"></i>
                            Simpan Transaksi & Cetak Struk
                        </button>

                    </div>
                </form>

            </div>

        </div>

    </div>

    <script>
        let keranjang = [];

        document.getElementById('searchBarang').addEventListener('keyup', function() {
            let keyword = this.value.toLowerCase();

            document.querySelectorAll('.barang-item').forEach(item => {
                item.style.display =
                    item.innerText.toLowerCase().includes(keyword)
                    ? ''
                    : 'none';
            });
        });

        function tambahKeKeranjang(id, nama, harga, stokMax) {
            let item = keranjang.find(b => b.id === id);

            if (item) {
                if (item.qty < stokMax) {
                    item.qty++;
                } else {
                    alert('Melebihi stok yang tersedia!');
                }
            } else {
                keranjang.push({
                    id,
                    nama,
                    harga,
                    qty: 1,
                    stokMax
                });
            }

            renderKeranjang();
        }

        function ubahQty(id, aksi) {
            let item = keranjang.find(b => b.id === id);

            if (item) {
                if (aksi === 'plus' && item.qty < item.stokMax) {
                    item.qty++;
                } else if (aksi === 'minus' && item.qty > 1) {
                    item.qty--;
                }
            }

            renderKeranjang();
        }

        function hapusItem(id) {
            keranjang = keranjang.filter(b => b.id !== id);
            renderKeranjang();
        }

        function renderKeranjang() {

            const tbody = document.getElementById('isiKeranjang');
            const keranjangKosong = document.getElementById('keranjangKosong');
            const tabelKeranjang = document.getElementById('tabelKeranjang');
            const btnSimpan = document.getElementById('btnSimpan');
            const tampilanTotal = document.getElementById('tampilanTotal');
            const inputTotalHarga = document.getElementById('inputTotalHarga');
            const jumlahItem = document.getElementById('jumlahItem');

            tbody.innerHTML = '';

            let total = 0;
            let totalItem = 0;

            if (keranjang.length === 0) {

                keranjangKosong.classList.remove('hidden');
                tabelKeranjang.classList.add('hidden');
                btnSimpan.disabled = true;

            } else {

                keranjangKosong.classList.add('hidden');
                tabelKeranjang.classList.remove('hidden');
                btnSimpan.disabled = false;

                keranjang.forEach(item => {

                    let subtotal = item.qty * item.harga;

                    total += subtotal;
                    totalItem += item.qty;

                    tbody.innerHTML += `
                    <tr class="border-b">
                        <td class="px-4 py-4">
                            ${item.nama}
                            <input type="hidden" name="barang_id[]" value="${item.id}">
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-2">

                                <button type="button"
                                    onclick="ubahQty(${item.id},'minus')"
                                    class="w-7 h-7 rounded bg-gray-100">
                                    -
                                </button>

                                <input
                                    readonly
                                    type="number"
                                    name="qty[]"
                                    value="${item.qty}"
                                    class="w-10 text-center border-none bg-transparent"
                                >

                                <button type="button"
                                    onclick="ubahQty(${item.id},'plus')"
                                    class="w-7 h-7 rounded bg-gray-100">
                                    +
                                </button>

                            </div>
                        </td>

                        <td class="px-4 py-4 text-right font-semibold text-green-600">
                            Rp ${subtotal.toLocaleString('id-ID')}
                        </td>

                        <td class="px-4 py-4 text-center">
                            <button type="button"
                                onclick="hapusItem(${item.id})"
                                class="text-red-500">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    `;
                });
            }

            jumlahItem.innerText = totalItem;
            tampilanTotal.innerText = 'Rp ' + total.toLocaleString('id-ID');
            inputTotalHarga.value = total;
        }
    </script>

</x-app-layout>