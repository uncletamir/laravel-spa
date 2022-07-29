<template>
    <div class="container">
        <div class="justify-content-center mt-5">

            <div class="col-lg">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-file-alt"></i>
                  Manifest Event
                </h3>
                <pre>id: {{ id }}</pre>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <dl>
                  <dt>Nama Event</dt>
                  <dd>A description list is perfect for defining terms.</dd>
                  <dt>Alamat Event</dt>
                  <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                  <dt>Tanggal Event</dt>
                  <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                  <dt>Penanggung Jawab</dt>
                  <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                </dl>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->

            <div class="col-lg">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Details Data Manifest</h3>
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
                                        <th>Nama Inventory</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr v-for="item in dt_manifests" :key="item.id">
                                        <td>{{ item.nama_inventory }}</td>
                                        <td>{{ item.Jumlah_inventory }}</td>
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
                                <input
                                    type="text"
                                    v-model="form.manifest_id"
                                    class="form-control"
                                    placeholder="Manifest ID"
                                    :class="{
                                        'is-invalid': form.errors.has('manifest_id')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="manifest_id"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    v-model="form.inventory_id"
                                    class="form-control"
                                    placeholder="Inventory ID"
                                    :class="{
                                        'is-invalid': form.errors.has('inventory_id')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="inventory_id"
                                ></has-error>
                            </div>
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
                                        v-for="item in inventorys"
                                        :key="item.id"
                                        :value="item.id"
                                    >
                                        {{ item.nama_inventory }}
                                    </option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="nama_inventory"
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
                                    type="number"
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
export default {
    props: ['item.id'],
    
    data() {
        
        return {
            id: "",
            loading: false,
            disabled: false,
            inventorys: {},
            dt_manifests: {},
            statusmodal: false,
            form: new Form({
                id: "",
                manifest_id:"",
                inventory_id:"",
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
        loadData() {
            this.$Progress.start();   
            this.id.push(route.params.id);   
            console.log(id);
            axios
                .get("api/manifest")
                .then(({ data }) => (this.inventorys = data));
            axios
                .get("api/inventory")
                .then(({ data }) => (this.inventorys = data));
            axios.get("api/detail-manifest").then(({ data }) => (this.dt_manifestss = data));
            this.$Progress.finish();
        },
        simpanData() {
            this.$Progress.start();
            this.loading = true;
            this.disabled = true;
            this.form
                .post("api/user")
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
                .put("api/user/" + this.form.id)
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
                        .delete("api/user/" + id)
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
