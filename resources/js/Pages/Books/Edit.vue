
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    book: Object,
});

const form = useForm({
    kode_buku: props.book.kode_buku ?? "",
    judul: props.book.judul ?? "",
    pengarang: props.book.pengarang ?? "",
    penerbit: props.book.penerbit ?? "",
    tahun: props.book.tahun ?? "",
    stok: props.book.stok ?? 0,
});

function submit() {
    form.put(route("books.update", props.book.id));
}
</script>

<template>
    <Head title="Edit Buku" />

    <AuthenticatedLayout>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Buku</h1>

            <div class="bg-white shadow-sm rounded-lg p-6 max-w-2xl">
                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <label class="block font-medium mb-1">
                            Kode Buku
                        </label>
                        <input
                            v-model="form.kode_buku"
                            type="text"
                            class="w-full border border-gray-300 rounded-md p-2"
                            required
                        />
                        <p v-if="form.errors.kode_buku" class="text-red-500 text-sm mt-1">
                            {{ form.errors.kode_buku }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">
                            Judul
                        </label>
                        <input
                            v-model="form.judul"
                            type="text"
                            class="w-full border border-gray-300 rounded-md p-2"
                            required
                        />
                        <p v-if="form.errors.judul" class="text-red-500 text-sm mt-1">
                            {{ form.errors.judul }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">
                            Pengarang
                        </label>
                        <input
                            v-model="form.pengarang"
                            type="text"
                            class="w-full border border-gray-300 rounded-md p-2"
                            required
                        />
                        <p v-if="form.errors.pengarang" class="text-red-500 text-sm mt-1">
                            {{ form.errors.pengarang }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">
                            Penerbit
                        </label>
                        <input
                            v-model="form.penerbit"
                            type="text"
                            class="w-full border border-gray-300 rounded-md p-2"
                        />
                        <p v-if="form.errors.penerbit" class="text-red-500 text-sm mt-1">
                            {{ form.errors.penerbit }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">
                            Tahun
                        </label>
                        <input
                            v-model="form.tahun"
                            type="number"
                            class="w-full border border-gray-300 rounded-md p-2"
                        />
                        <p v-if="form.errors.tahun" class="text-red-500 text-sm mt-1">
                            {{ form.errors.tahun }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">
                            Stok
                        </label>
                        <input
                            v-model="form.stok"
                            type="number"
                            min="0"
                            class="w-full border border-gray-300 rounded-md p-2"
                            required
                        />
                        <p v-if="form.errors.stok" class="text-red-500 text-sm mt-1">
                            {{ form.errors.stok }}
                        </p>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="bg-blue-600 hover:bg-blue-700 disabled:opacity-50 text-white px-4 py-2 rounded-md"
                        >
                            {{ form.processing ? "Menyimpan..." : "Simpan Perubahan" }}
                        </button>

                        <Link
                            href="/books"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md"
                        >
                            Kembali
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
