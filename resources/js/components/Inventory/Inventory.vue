<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Inventory</h3>
                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-success"
                                @click="showModal"
                            >
                                Tambah Inventory
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Lokasi</th>
                                        <th>Nama Inventory</th>
                                        <th>Jumlah Inventory</th>
                                        <th>QR Code</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr v-for="item in inventorys" :key="item.id">
                                        <td>{{ item.kategori_id }}</td>
                                        <td>{{ item.lokasi_id }}</td>
                                        <td>{{ item.nama_inventory }}</td>
                                        <td>{{ item.jumlah_inventory }}</td>
                                        <!-- <td>
                                            <qrcode-vue
                                            :value="item.id"
                                            background="#0b3954"
                                            foreground="#20fc8f"
                                            size="100"
                                            level="H"
                                            ></qrcode-vue>
                                        </td> -->
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-success"
                                                @click="showModalQr(item)"
                                            >
                                                QR
                                            </button>
                                            <!-- <a 
                                            href="#"
                                            @click="showModalQr(item)"
                                            ><i class="fas fa-edit blue"></i
                                            ></a> -->
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
        <!-- ModalQr -->
        <div
            class="modal fade"
            id="modalqrmuncul"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalqrmuncul1"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       
                        <h5
                            class="modal-title"
                            id="exampleModalLongTitle"
                            v-show="statusmodal"
                        >
                            Qr Code
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
                    <div class="modal-body">
                        <div class="info-box">
                            <span class="info-box">
                                <qrcode-vue
                                :value="form.id"
                                background="#FFFFFF"
                                foreground="#000000"
                                size="100"
                                level="H"
                                ></qrcode-vue>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">{{ form.nama_inventory }}</span>
                                <span class="info-box-text">ID: Antera_{{ form.kategori_id }}{{ form.id }}</span>                                
                            </div>
                        <!-- /.info-box-content -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- /ModalQr -->

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
                            Tambah Inventory
                        </h5>
                        <h5
                            class="modal-title"
                            id="exampleModalLongTitle"
                            v-show="statusmodal"
                        >
                            Ubah Inventory
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
                                <select
                                    class="form-control select2"
                                    v-model="form.kategori_id"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'kategori_id'
                                        )
                                    }"
                                >
                                    <option value> Pilih Kategori </option>
                                    <option
                                        v-for="item in kategoris"
                                        :key="item.id"
                                        :value="item.id"
                                    >
                                        {{ item.nama_kategori }}
                                    </option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="kategori_id"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <select
                                    class="form-control select1"
                                    v-model="form.lokasi_id"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'lokasi_id'
                                        )
                                    }"
                                >
                                    <option value> Pilih Lokasi </option>
                                    <option
                                        v-for="item in lokasis"
                                        :key="item.id"
                                        :value="item.id"
                                    >
                                        {{ item.nama_lokasi }}
                                    </option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="lokasi_id"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    v-model="form.nama_inventory"
                                    class="form-control"
                                    placeholder="Nama Inventory"
                                    :class="{
                                        'is-invalid': form.errors.has('nama_inventory')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="nama_inventory"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    v-model="form.jumlah_inventory"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('jumlah_inventory')
                                    }"
                                    placeholder="Jumlah Inventory"
                                />
                                <has-error
                                    :form="form"
                                    field="jumlah_inventory"
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
import QrcodeVue from "qrcode.vue";
export default {
    components: {
    QrcodeVue,
  },
    data() {
        return {
            loading: false,
            disabled: false,
            kategoris: {},
            lokasis: {},
            inventorys: {},
            statusmodal: false,
            form: new Form({
                id: "",
                kategori_id: "",
                lokasi_id: "",
                nama_inventory: "",
                jumlah_inventory: ""
            })
        };
    },
    methods: {
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
        showModalQr(item) {
            this.statusmodal = true;
            this.form.reset();
            $("#modalqrmuncul").modal("show");
            this.form.fill(item);
        },
        loadData() {
            this.$Progress.start();
            axios
                .get("api/kategori")
                .then(({ data }) => (this.kategoris = data));
            axios
            .get("api/lokasi")
            .then(({ data }) => (this.lokasis = data));
            axios.get("api/inventory").then(({ data }) => (this.inventorys = data));
            this.$Progress.finish();
        },
        simpanData() {
            this.$Progress.start();
            this.loading = true;
            this.disabled = true;
            this.form
                .post("api/inventory")
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
                .put("api/inventory/" + this.form.id)
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
                        .delete("api/inventory/" + id)
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

