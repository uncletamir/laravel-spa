<template>
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manifest Event </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Print Manifest</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">            


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <img src="/dist/img/logo-inverse.png" alt="" class="w-25 p-3">
                    <small class="float-right">{{ date }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                 <h4>Details Event</h4>
                  <address>
                    <strong>{{ datasp.nama_event }}</strong><br>
                    {{ datasp.alamat_event }}
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #EV-M-{{ datasp.id }}</b><br>
                  <br>
                  <!-- <b>Order ID:</b> 4F3S8J<br> -->
                  <b>Tanggal Event:</b> {{ datasp.tanggal_event }}<br>
                  <b>Penanggung Jawab:</b> {{ datasp.penanggung_jawab }}
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">Qty</th>
                      <th class="text-center">Inventory</th>
                      <th class="text-center">ID #</th>
                      <th class="text-center">Check List Pasang</th>
                      <th class="text-center">Check List Bongkar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in dtInvenp" :key="item.id">
                      <td class="text-center">{{ item.jumlah_inventory }}</td>
                      <td class="text-center">{{ item.nama_inventory }}</td>
                      <td class="text-center">INV-ID-{{ item.inventory_id }}</td>
                      <td class="text-center"><input type="checkbox" class="form-check-input" id="exampleCheck1"></td>
                      <td class="text-center"><input type="checkbox" class="form-check-input" id="exampleCheck2"></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <!-- <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div> -->
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Created at {{ date }}</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Total Inventory:</th>
                        <td>{{ dtInvenp.length }}</td>
                      </tr>                      
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                  <!-- <button type="button" class="btn btn-success float-right"><i class="fa fa-credit-card"></i> Submit
                    Payment
                  </button> -->
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
export default {
    props:['itemId'],
    data() {
        return {
            loading: false,
            disabled: false,
            date:'',
            datasp: {},
            dtInvenp:{},
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
        printDate() {
            return new Date().toLocaleDateString();
        },
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
                 .then(response => this.datasp = response.data); 
                axios.get("/api/detail-manifest/" + this.itemId)
                .then(response => this.dtInvenp = response.data);            
            this.$Progress.finish();
        },
        simpanData() {
            this.$Progress.start();
            this.loading = true;
            this.disabled = true;
            this.form
                .post("api/detail-manifest")
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
                .put("api/detail-manifest" + this.form.id)
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
                        .delete("api/detail-manifest" + id)
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
        this.date = this.printDate();
        this.loadData();
        Fire.$on("refreshData", () => {
            this.loadData();
        });
    }
};
</script>