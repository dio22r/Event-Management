var index = new Vue({
  el: "#app-vue",

  data: {
    count_start: 1,
    page: 1,
    search: "",
    current_page: 1,
    total_page: 1,
    perpage: 20,

    status_lunas: 0,
    retrieve_process: false,

    items: [],
    data_peserta: {
      nama: "",
      alamat: "",
      kontak: "",
    },
  },

  methods: {
    get_all: function () {
      that = this;

      let url = "/admin/amplop/all";

      let datasend = {
        params: {
          page: this.current_page,
          limit: this.perpage,
          search: this.search,
          status: 1,
          status_kembali: "all",
        },
      };

      axios.get(url, datasend).then((response) => {
        if (response.data.status) {
          that.items = response.data.data;
          that.total_page = response.data.totalpage;
          that.count_start = (that.current_page - 1) * that.perpage + 1;
        }
      });
    },

    on_search: function (e) {
      e.preventDefault();
      this.current_page = 1;
      this.get_all();
    },

    pagination: function (pagejump, event) {
      event.preventDefault();
      if (
        this.current_page + pagejump >= 1 &&
        this.current_page + pagejump <= this.total_page
      ) {
        this.current_page = this.current_page + pagejump;
        this.get_all();
      }
    },

    // view_detail: function (id, e) {
    //   e.preventDefault();
    //   this.retrieve_process = false;
    //   let table = document.getElementById("data-view");
    //   let url = table.getAttribute("data-url");

    //   axios.get(url + "/" + id).then((response) => {
    //     that.data_peserta = response.data.data;
    //     this.retrieve_process = true;
    //   });
    // },

    // action_delete: function (id, e) {
    //   e.preventDefault();
    //   let conf = confirm("Apakah Anda akan Menghapus data ini?");

    //   if (conf) {
    //     let table = document.getElementById("data-view");
    //     let url = table.getAttribute("data-url");

    //     axios.delete(url + "/" + id).then((response) => {
    //       alert("Data berhasil dihapus!");
    //       document.getElementById("btn-close").click();
    //       this.get_all();
    //     });
    //   }
    // },
  },

  mounted: function () {
    this.get_all();
  },
});
