<template>
    <div id="app">
        <table>
            <tr>
                <!-- <td width="60px"><img src="../src/assets/logo.png" width="50px"></td> -->
                <td>
                    <span class="table-title"><b>#qrcode reader</b></span>
                    <br>
                    <span class="table-desc">Made with <span class="vue-font">Vue.js</span></span>
                </td>
            </tr>
        </table>

        <hr>

        <div class="row">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <download-excel class="btn btn-sm btn-success" :data="qrcodes" :fields="qrcode_fields" name="data.xls">
                        Export Excel
                        </download-excel>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody v-for="(qrcode, index) in qrcodes" :key="qrcode.id">
                                <tr>
                                    <th scope="row">{{ qrcode.id }}</th>
                                    <td>{{ qrcode.data }}</td>
                                    <td>{{ qrcode.date }}</td>
                                    <td>
                                        <a href="#" @click.prevent="deleteQrcode(index)">x</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-md-4">

                <div class="card" style="width: 18rem;">
                    <qrcode-stream @decode="onDecode" @init="onInit" />
                    <div class="card-body">
                        <p class="card-text">Please scan the qrcode.</p>
                        <hr>
                        <div class="alert" :class="alert" role="alert">
                            {{ status }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { QrcodeStream } from 'vue-qrcode-reader';
export default {
  name: 'qrstream',
  data() {
    return {
      qrcodes: [
        {
          id: 1,
          data: 'Lorem',
          date: new Date().toJSON().slice(0,10).replace(/-/g,'/'),
        },
        {
          id: 2,
          data: 'Ipsum',
          date: new Date().toJSON().slice(0,10).replace(/-/g,'/'),
        }
      ],
      qrcode_fields: {
          'No': 'id',
          'Data': 'data',
          'Created at': 'date',
      },
      error: '',
      status: 'Webcam ready!',
      alert: 'alert-warning',
      idQrcode: 3
    }
  },
  components: { QrcodeStream },
  methods: {
    deleteQrcode(index) {
      this.qrcodes.splice(index, 1)
    },
    async onDecode (result) {
      this.qrcodes.push({
        id: this.idQrcode,
        data: result,
        date: new Date().toJSON().slice(0,10).replace(/-/g,'/')
      })
      this.idQrcode++
      let audio = await new Audio('http://soundbible.com/mp3/Bike Horn-SoundBible.com-602544869.mp3')
      audio.play()
      this.alert = 'alert-success'
      this.status = 'Success!'
      setTimeout(() => {
        this.status = 'Webcam ready!',
        this.alert = 'alert-warning'
      }, 3000)
    },
    async onInit (promise) {
      try {
        await promise
      } catch (error) {
        let audio = await new Audio('http://soundbible.com/mp3/Industrial Alarm-SoundBible.com-1012301296.mp3')
        audio.play()
        if (error.name === 'NotAllowedError') {
          this.alert = 'alert-danger'
          this.status = "ERROR: you need to grant camera access permisson"
        } else if (error.name === 'NotFoundError') {
          this.alert = 'alert-danger'
          this.status = "ERROR: no camera on this device"
        } else if (error.name === 'NotSupportedError') {
          this.alert = 'alert-danger'
          this.status = "ERROR: secure context required (HTTPS, localhost)"
        } else if (error.name === 'NotReadableError') {
          this.alert = 'alert-danger'
          this.status = "ERROR: is the camera already in use?"
        } else if (error.name === 'OverconstrainedError') {
          this.alert = 'alert-danger'
          this.status = "ERROR: installed cameras are not suitable"
        } else if (error.name === 'StreamApiNotSupportedError') {
          this.alert = 'alert-danger'
          this.status = "ERROR: Stream API is not supported in this browser"
        }
      }
    }
  }
}
</script>

