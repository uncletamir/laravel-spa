<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Manifest</h3>
                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-success"
                                @click="showModal"
                            >
                                Tambah Kategori
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Nama Event</th>
                                        <th>Lokasi Event</th>
                                        <th>Tanggal Event</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Details Inventory Event</th>                                        
                                        <th>Aksi</th>
                                    </tr>
                                    <tr v-for="item in manifests" :key="item.id">
                                        <td>{{ item.nama_event }}</td>
                                        <td>{{ item.alamat_event }}</td>
                                        <td>{{ item.tanggal_event }}</td>
                                        <td>{{ item.penanggung_jawab }}</td>
                                        <td>
                                            <router-link :to="'/detail-manifest/' + item.id + '/details'">Details</router-link>
                                            <!-- <button
                                                type="button"
                                                class="btn btn-success"
                                                @click="goToDetail(item.id)"
                                            >
                                                Detail Barang
                                            </button> -->
                                        </td>
                                        <td>
                                            <a
                                                href="#"
                                                @click="showModalEdit(item)"
                                                ><i class="fas fa-edit blue"></i
                                            ></a>
                                            |<a
                                                href="#"
                                                @click="deleteData(item.id)"
                                                ><i
                                                    class="fas fa-trash-alt red"
                                                ></i
                                            ></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="modalmuncul"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalmuncul1"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="exampleModalLongTitle"
                            v-show="!statusmodal"
                        >
                            Tambah Manifest
                        </h5>
                        <h5
                            class="modal-title"
                            id="exampleModalLongTitle"
                            v-show="statusmodal"
                        >
                            Ubah Manifest
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form
                        @submit.prevent="
                            statusmodal ? ubahData() : simpanData()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <input
                                    type="text"
                                    v-model="form.nama_event"
                                    class="form-control"
                                    placeholder="Nama Event"
                                    :class="{
                                        'is-invalid': form.errors.has('nama_event')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="nama_event"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    v-model="form.alamat_event"
                                    class="form-control"
                                    placeholder="Lokasi Event"
                                    :class="{
                                        'is-invalid': form.errors.has('alamat_event')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="alamat_event"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <input
                                    type="date"
                                    v-model="form.tanggal_event"
                                    class="form-control"
                                    placeholder="Tanggal Event"
                                    :class="{
                                        'is-invalid': form.errors.has('tanggal_event')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="tanggal_event"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    v-model="form.penanggung_jawab"
                                    class="form-control"
                                    placeholder="Penanggung Jawab Event"
                                    :class="{
                                        'is-invalid': form.errors.has('penanggung_jawab')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="penanggung_jawab"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    v-model="form.note"
                                    class="form-control"
                                    placeholder="Note"
                                    :class="{
                                        'is-invalid': form.errors.has('note')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="note"
                                ></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="disabled"
                                v-show="!statusmodal"
                            >
                                <i
                                    v-show="loading"
                                    class="fa fa-spinner fa-spin"
                                ></i>
                                Simpan
                            </button>
                            <button
                                type="submit"
                                class="btn btn-success"
                                :disabled="disabled"
                                v-show="statusmodal"
                            >
                                <i
                                    v-show="loading"
                                    class="fa fa-spinner fa-spin"
                                ></i>
                                Ubah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Modal -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            disabled: false,
            manifests: {},
            statusmodal: false,
            form: new Form({
                id: "",
                nama_event:"",
                alamat_event:"",
                tanggal_event:"",
                penanggung_jawab:"",
                note:""               
            })
        };
    },
    
    methods: {
        // goToDetail(item){
        //     // this.$router.push('/detail-manifest');
        //     this.$router.push({path:'/detail-manifest', params: {id: "1" }}); 
        // },
        showModal() {
            this.statusmodal = false;
            this.form.reset();
            $("#modalmuncul").modal("show");
        },
        showModalEdit(item) {
            this.statusmodal = true;
            this.form.reset();
            $("#modalmuncul").modal("show");
            this.form.fill(item);
        },
        loadData() {
            this.$Progress.start();
            axios
                .get("api/manifest")
                .then(({ data }) => (this.manifests = data));            
            this.$Progress.finish();
        },
        simpanData() {
            this.$Progress.start();
            this.loading = true;
            this.disabled = true;
            this.form
                .post("api/manifest")
                .then(() => {
                    Fire.$emit("refreshData");
                    $("#modalmuncul").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Data Berhasil Tersimpan"
                    });
                    this.$Progress.finish();
                    this.loading = false;
                    this.disabled = false;
                })
                .catch(() => {
                    this.$Progress.fail();
                    this.loading = false;
                    this.disabled = false;
                });
        },
        ubahData() {
            this.$Progress.start();
            this.loading = true;
            this.disabled = true;
            this.form
                .put("api/manifest/" + this.form.id)
                .then(() => {
                    Fire.$emit("refreshData");
                    $("#modalmuncul").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Data Berhasil Terupdate"
                    });
                    this.$Progress.finish();
                    this.loading = false;
                    this.disabled = false;
                })
                .catch(() => {
                    this.$Progress.fail();
                    this.loading = false;
                    this.disabled = false;
                });
        },
        deleteData(id) {
            Swal.fire({
                title: "Anda Yakin Ingin Menghapus Data Ini ?",
                text: "Klik Batal Untuk Membatalkan Penghapusan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus"
            }).then(result => {
                if (result.value) {
                    this.form
                        .delete("api/manifest/" + id)
                        .then(() => {
                            Swal.fire(
                                "Terhapus",
                                "Data Anda Sudah Tehapus",
                                "success"
                            );
                            Fire.$emit("refreshData");
                        })
                        .catch(() => {
                            Swal.fire(
                                "Gagal",
                                "Data Gagal Terhapus",
                                "warning"
                            );
                        });
                }
            });
        }
    },
    created() {
        this.loadData();
        Fire.$on("refreshData", () => {
            this.loadData();
        });
    }
};
</script>
