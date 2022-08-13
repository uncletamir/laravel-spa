<template>
<div class="content-wrapper">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-text-width"></i>
                  Data Manifest
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <dl class="dl-horizontal">
                  <dt>Nama Event</dt>
                  <dd>{{ datas.nama_event }}</dd>
                  <dt>Alamat Event</dt>
                  <dd>{{ datas.alamat_event }}</dd>
                  <dt>Tanggal Event</dt>
                  <dd>{{ datas.tanggal_event }}</dd>
                  <dt>Penanggung Jawab</dt>
                  <dd>{{ datas.penanggung_jawab }}</dd>
                </dl>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div> 
        
        <div class="row justify-content-center mt-5">            
            <div class="col-lg">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Kategori</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Nama Kategori</th>
                                        <th>Jumlah Inventory</th>
                                        <th>Status</th>                                        
                                        <th>Aksi</th>
                                    </tr>
                                    <tr v-for="item in dtInven" :key="item.id">
                                        <td>{{ item.nama_inventory }}</td>
                                        <td>{{ item.jumlah_inventory }}</td>
                                        <td>{{ item.id }}</td>
                                        <!-- <td v-if= "{{ item.jumlah_inventory }} = 0">Sudah dikembalikan</td>
                                        <td v-else> Belum dikembalikan</td> -->
                                        <td>
                                             <button type="button" class="btn btn-success" @click="deleteData(item.id)">Kembalikan</button>
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
        <!-- <div
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
                                    placeholder="ID Manifest"
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
                                    placeholder="ID Inventory"
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
                                    placeholder="Jumlah Inventory"
                                    :class="{
                                        'is-invalid': form.errors.has('jumlah_inventory')
                                    }"
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
        </div> -->
        <!-- /Modal -->
    </div>
</div>
    
</template>

<script>
export default {
    props:['itemId'],
    data() {
        return {
            loading: false,
            disabled: false,
            datas: {},
            dtInven:{},
            statusmodal: false,
            form: new Form({
                id: "",
                manifest_id:"",
                inventory_id:"",
                nama_inventory: "",
                jumlah_inventory:""
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
                axios.get("/api/manifest/" + this.itemId)
                 .then(response => this.datas = response.data); 
                axios.get("/api/detail-manifest/" + this.itemId)
                .then(response => this.dtInven = response.data);            
            this.$Progress.finish();
        },
        simpanData() {
            this.$Progress.start();
            this.loading = true;
            this.disabled = true;
            this.form
                .post("/api/detail-manifest")
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
                .put("/api/detail-manifest/" + this.form.id)
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
                title: "Apakah Inventory Sudah Lengkap ?",
                text: "Pastikan Inventory Sudah Lengkap!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Kembalikan"
            }).then(result => {
                if (result.value) {
                    this.form
                        .delete("/api/pengembalian-manifest/" + id)
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
