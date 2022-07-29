<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cari Inventory</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input v-model="keywords" class="form-control" type="search" placeholder="Cari Inventory ..." aria-label="Search">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Inventory</h3>
                        <div class="card-tools">
                            
                            <!-- <button
                                type="button"
                                class="btn btn-success"
                                @click="showModal"
                            >
                                Tambah Kategori
                            </button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Nama Inventory</th>
                                        <th>Jumlah Inventory</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr v-for="(result,k) in results" :key="k">
                                        <td>{{ result.nama_inventory }}</td>
                                        <td>
                                            <select class="form-control">
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </td>
                                        <td><button @click="add" v-show="k == results.length-1" type="button" class="btn btn-block btn-success btn-sm">Tambah</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Inventory</h3>
                        <div class="card-tools">
                            
                            <!-- <button
                                type="button"
                                class="btn btn-success"
                                @click="showModal"
                            >
                                Tambah Kategori
                            </button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Nama Inventory</th>
                                        <th>Jumlah Inventory</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr>
                                        <pre>{{ JSON.stringify(this.lists, null, 2) }}</pre>
                                    </tr>
                                    <tr v-for="list in lists" :key="list.id">
                                        <td>{{ list.nama_inventory }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="form-group" v-for="(list,k) in lists" :key="k">
                        <input type="text" class="form-control" v-model="list.name">
                        <span>
                            <i class="fas fa-minus-circle" @click="remove(k)" v-show="k || ( !k && lists.length > 1)"></i>
                            <i class="fas fa-plus-circle" @click="add(k)" v-show="k == lists.length-1"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Data Dipilih</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Nama Inventory</th>
                                        <th>Jumlah Inventory</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr v-for="(datapick) in datapicks" :key="result.id">
                                        <td>{{ result.nama_inventory }}</td>
                                        <td>
                                            <select class="form-control">
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </td>
                                        <td><button type="button" class="btn btn-block btn-success btn-sm">Tambah</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>
    </div>
</template>

<script>
// import func from 'vue-editor-bridge';
export default {
    data() {
        return {
            keywords: null,
            results: [],
            lists: [],
        };        
    },
    watch: {
        keywords(after, before) {
            this.fetch();
        }
    },
    methods: {
        fetch() {
            axios.get('/api/search', { params: { keywords: this.keywords } })
                .then(response => this.results = response.data)
                .catch(error => {});
        },
        add(results) {
            this.results.push({
                ...this.lists
            });
            console.log(this.results);
        },
        remove() {
            this.lists.splice(index, 1);
        }
    }
    // data() {
    //     return {
    //         loading: false,
    //         disabled: false,
    //         kategoris: {},
    //         searchQuery: null,
    //         statusmodal: false,
    //         form: new Form({
    //             id: "",
    //             nama_kategori: ""
    //         })
    //     };
    // },
    // methods: {
    //     showModal() {
    //         this.statusmodal = false;
    //         this.form.reset();
    //         $("#modalmuncul").modal("show");
    //     },
    //     showModalEdit(item) {
    //         this.statusmodal = true;
    //         this.form.reset();
    //         $("#modalmuncul").modal("show");
    //         this.form.fill(item);
    //     },
    //     loadData() {
    //         this.$Progress.start();
    //         axios
    //             .get("api/kategori")
    //             .then(({ data }) => (this.kategoris = data));            
    //         this.$Progress.finish();
    //     },
    //     simpanData() {
    //         this.$Progress.start();
    //         this.loading = true;
    //         this.disabled = true;
    //         this.form
    //             .post("api/kategori")
    //             .then(() => {
    //                 Fire.$emit("refreshData");
    //                 $("#modalmuncul").modal("hide");
    //                 Toast.fire({
    //                     icon: "success",
    //                     title: "Data Berhasil Tersimpan"
    //                 });
    //                 this.$Progress.finish();
    //                 this.loading = false;
    //                 this.disabled = false;
    //             })
    //             .catch(() => {
    //                 this.$Progress.fail();
    //                 this.loading = false;
    //                 this.disabled = false;
    //             });
    //     },
    //     ubahData() {
    //         this.$Progress.start();
    //         this.loading = true;
    //         this.disabled = true;
    //         this.form
    //             .put("api/kategori/" + this.form.id)
    //             .then(() => {
    //                 Fire.$emit("refreshData");
    //                 $("#modalmuncul").modal("hide");
    //                 Toast.fire({
    //                     icon: "success",
    //                     title: "Data Berhasil Terupdate"
    //                 });
    //                 this.$Progress.finish();
    //                 this.loading = false;
    //                 this.disabled = false;
    //             })
    //             .catch(() => {
    //                 this.$Progress.fail();
    //                 this.loading = false;
    //                 this.disabled = false;
    //             });
    //     },
    //     deleteData(id) {
    //         Swal.fire({
    //             title: "Anda Yakin Ingin Menghapus Data Ini ?",
    //             text: "Klik Batal Untuk Membatalkan Penghapusan",
    //             icon: "warning",
    //             showCancelButton: true,
    //             confirmButtonColor: "#3085d6",
    //             cancelButtonColor: "#d33",
    //             confirmButtonText: "Hapus"
    //         }).then(result => {
    //             if (result.value) {
    //                 this.form
    //                     .delete("api/kategori/" + id)
    //                     .then(() => {
    //                         Swal.fire(
    //                             "Terhapus",
    //                             "Data Anda Sudah Tehapus",
    //                             "success"
    //                         );
    //                         Fire.$emit("refreshData");
    //                     })
    //                     .catch(() => {
    //                         Swal.fire(
    //                             "Gagal",
    //                             "Data Gagal Terhapus",
    //                             "warning"
    //                         );
    //                     });
    //             }
    //         });
    //     }
    // },
    // created() {
    //     this.loadData();
    //     Fire.$on("refreshData", () => {
    //         this.loadData();
    //     });
    // }
    
};
</script>
