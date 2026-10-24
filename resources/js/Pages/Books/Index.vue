
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, router, usePage } from '@inertiajs/vue3';

defineProps({
    books: {
        type: Object,
        default: () => ({ data: [] }),
    },
});

const page = usePage();

function hapus(id) {
    if (confirm('Yakin ingin menghapus buku ini?')) {
        router.delete(`/books/${id}`, {
            preserveScroll: true,
        });
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="min-h-screen bg-gray-100 p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Data Buku
                </h1>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola data buku perpustakaan Anda.
                </p>
            </div>

            <!-- Pesan sukses, ditampilkan jika tersedia -->
            <div
                v-if="page.props.flash?.success"
                class="mb-4 rounded-md border border-green-200 bg-green-100 p-4 text-green-700"
            >
                {{ page.props.flash.success }}
            </div>

            <!-- Tombol tambah buku -->
            <div class="mb-4">
                <Link
                    href="/books/create"
                    class="inline-block rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                >
                    + Tambah Buku
                </Link>
            </div>

            <!-- Tabel data buku -->
            <div class="overflow-x-auto rounded-lg bg-white shadow-sm">
                <table
                    class="w-full border-collapse border border-gray-300"
                >
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-3 text-left">
                                Kode
                            </th>
                            <th class="border border-gray-300 p-3 text-left">
                                Judul
                            </th>
                            <th class="border border-gray-300 p-3 text-left">
                                Pengarang
                            </th>
                            <th class="border border-gray-300 p-3 text-center">
                                Stok
                            </th>
                            <th class="border border-gray-300 p-3 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="book in (books?.data ?? [])"
                            :key="book.id"
                            class="hover:bg-gray-50"
                        >
                            <td class="border border-gray-300 p-3">
                                {{ book.kode_buku }}
                            </td>

                            <td class="border border-gray-300 p-3">
                                {{ book.judul }}
                            </td>

                            <td class="border border-gray-300 p-3">
                                {{ book.pengarang }}
                            </td>

                            <td class="border border-gray-300 p-3 text-center">
                                {{ book.stok }}
                            </td>

                            <td class="border border-gray-300 p-3">
                                <div class="flex justify-center gap-2">
                                    <Link
                                        :href="`/books/${book.id}/edit`"
                                        class="rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600"
                                    >
                                        Edit
                                    </Link>

                                    <button
                                        type="button"
                                        @click="hapus(book.id)"
                                        class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr v-if="!(books?.data?.length)">
                            <td
                                colspan="5"
                                class="border border-gray-300 p-6 text-center text-gray-500"
                            >
                                Belum ada data buku.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
