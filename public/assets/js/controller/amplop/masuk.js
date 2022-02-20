var app = new Vue({
  el: "#app-vue",
  data: {
    scanner: null,
    activeCameraId: null,
    cameras: [],
    scans: [],

    dataAmplop: {
      nama: "",
      keterangan: "",
    },

    retrieve_process: false,
    total_data: 0,

    alertinfo: "Silahkan Scan QRCode dari amplop yang akan dibagikan.",
    alertclass: "alert-info",

    jumlah: "",
    ket_kembali: "",
    submitStatus: false,
  },

  mounted: function () {
    var self = this;

    self.scanner = new Instascan.Scanner({
      video: document.getElementById("preview"),
      scanPeriod: 5,
    });
    self.scanner.addListener("scan", function (content, image) {
      self.add_amplop(content);
    });
    Instascan.Camera.getCameras()
      .then(function (cameras) {
        self.cameras = cameras;
        if (cameras.length > 0) {
          let activeIndex = cameras.length - 1;
          self.activeCameraId = cameras[activeIndex].id;
          self.scanner.start(cameras[activeIndex]);
        } else {
          console.error("No cameras found.");
        }
      })
      .catch(function (e) {
        console.error(e);
      });
  },

  methods: {
    selectCamera: function (camera) {
      this.activeCameraId = camera.id;
      this.scanner.start(camera);
    },

    add_amplop: function (content) {
      let self = this;
      let base64 = content.replace(
        "https://panitiasatuabadgpdikp4.com/amplop/",
        ""
      );

      axios.get("/admin/amplop/cek/" + base64).then((response) => {
        if (response.data.arrData) {
          if (parseInt(response.data.arrData.status_kembali) === 0) {
            self.dataAmplop = response.data.arrData;
            self.alertclass = "alert-success";
            self.alertinfo =
              "Silahkan masukan jumlah isi amplop beserta keterangan";
            self.submitStatus = true;
          } else {
            self.alertclass = "alert-danger";
            self.alertinfo = "Data sudah ada";
            self.submitStatus = false;
          }
        } else {
          self.alertclass = "alert-danger";
          self.alertinfo = response.data.msg;
          self.submitStatus = false;
        }
      });
    },

    submit_data: function () {
      let self = this;

      if (!this.submitStatus) {
        return;
      }

      let isnum = /^\d+$/.test(this.jumlah);
      if (!this.jumlah || !isnum) {
        alert("Jumlah harus di isi dan berupa integer");
        return;
      }

      let formData = new FormData();

      formData.append("jumlah", this.jumlah);
      formData.append("ket_kembali", this.ket_kembali);
      formData.append("amplop_key", this.dataAmplop.amplop_key);

      axios.post("/admin/amplop/masuk", formData).then((response) => {
        if (response.data.status) {
          alert("Data sudah tersimpan");

          self.dataAmplop = {
            nama: "",
            keterangan: "",
          };
          self.jumlah = "";
          self.ket_kembali = "";
          self.submitStatus = false;
        }
      });
    },

    click_camera: function (index) {
      this.activeCameraId = this.cameras[index].id;
      this.scanner.start(this.cameras[index]);
    },
  },
});
