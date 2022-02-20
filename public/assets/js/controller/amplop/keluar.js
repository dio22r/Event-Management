var app = new Vue({
  el: "#app-vue",
  data: {
    scanner: null,
    activeCameraId: null,
    cameras: [],
    scans: [],

    amplop: [],
    count_start: 1,
    retrieve_process: false,
    total_data: 0,

    alertinfo: "Silahkan Scan QRCode dari amplop yang akan dibagikan.",
    alertclass: "alert-info",

    nama: "",
    keterangan: "",
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

      if (!this.amplop.includes(base64)) {
        axios.get("/admin/amplop/cek/" + base64).then((response) => {
          if (response.data.status) {
            self.amplop.push(base64);
            self.total_data = self.amplop.length;
            self.alertclass = "alert-success";
            self.alertinfo = "Data Diterima";
          } else {
            self.alertclass = "alert-danger";
            self.alertinfo = "Data Sudah ada";
          }
        });
      } else {
        self.alertclass = "alert-danger";
        self.alertinfo = "Data Sudah ada";
      }
    },

    rmv_amplop: function (base64) {
      this.amplop = this.amplop.filter(function (el) {
        return el != base64;
      });
      this.total_data = this.amplop.length;
    },

    submit_data: function () {
      let self = this;
      let formData = new FormData();

      formData.append("nama", this.nama);
      formData.append("keterangan", this.keterangan);

      this.amplop.forEach((element, index) => {
        formData.append(`amplop[${index}]`, element);
      });

      axios.post("/admin/amplop/keluar", formData).then((response) => {
        if (response.data.status) {
          alert("Data sudah tersimpan");
          self.amplop = [];
          self.nama = "";
          self.keterangan = "";
        }
      });
    },

    click_camera: function (index) {
      this.activeCameraId = this.cameras[index].id;
      this.scanner.start(this.cameras[index]);
    },
  },
});
