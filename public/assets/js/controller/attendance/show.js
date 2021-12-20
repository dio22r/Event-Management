var app = new Vue({
    el: "#app-vue",
    data: {
        scanner: null,
        activeCameraId: null,
        cameras: [],
        scans: [],

        items: [],
        current_page: 1,
        total_page: 1,
        count_start: 1,
        retrieve_process: false,
        perpage: 20,

        total_data: 0,

        detail: false,

        keyEvent: "",
        urlPost: "",
        urlGet: "",
    },

    mounted: function () {
        var self = this;

        this.keyEvent = initialValue.keyEvent;
        this.urlPost = initialValue.urlPost;
        this.urlGet = initialValue.urlGet;

        this.get_all();

        self.scanner = new Instascan.Scanner({
            video: document.getElementById("preview"),
            mirror: false,
            scanPeriod: 5,
        });
        self.scanner.addListener("scan", function (content, image) {
            self.getSubmitData(content);
        });
        Instascan.Camera.getCameras()
            .then(function (cameras) {
                self.cameras = cameras;
                if (cameras.length > 0) {
                    self.activeCameraId = cameras[0].id;
                    self.scanner.start(cameras[0]);
                } else {
                    console.error("No cameras found.");
                }
            })
            .catch(function (e) {
                console.error(e);
            });
    },

    methods: {
        addToast: function (data) {
            let toastContainer = document.querySelector(".toast-container");
            let elToast = document.createElement("div");
            elToast.classList.add(
                ...[
                    "toast",
                    "align-items-center",
                    "text-white",
                    "bg-primary",
                    "border-0",
                ]
            );
            elToast.setAttribute("role", "alert");
            elToast.setAttribute("aria-live", "assertive");
            elToast.setAttribute("aria-atomic", "true");
            elToast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                    Hello, world! This is a toast message.
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>`;

            console.log(toastContainer);
            toastContainer.appendChild(elToast);
        },

        selectCamera: function (camera) {
            this.activeCameraId = camera.id;
            this.scanner.start(camera);
        },

        getSubmitData: function (content) {
            let self = this;

            let arrData = content.split("/");
            let key = arrData[arrData.length - 1];

            let formData = new FormData();

            formData.append("key_event", this.keyEvent);
            formData.append("key", key);

            axios.post(this.urlPost, formData).then((response) => {
                self.detail = response.data;
                console.log(self.detail);
                if (response.data.status) {
                    self.addToast(response.data);

                    let toastElList = [].slice.call(
                        document.querySelectorAll(".toast")
                    );
                    let toastList = toastElList.map(function (toastEl) {
                        return new bootstrap.Toast(toastEl);
                    });

                    toastList.forEach((toast) => toast.show());

                    self.get_all();
                }
            });
        },

        get_all: function () {
            let that = this;

            let url = this.urlGet;

            let datasend = {
                params: {
                    key_event: this.keyEvent,
                    page: this.current_page,
                    limit: this.perpage,
                    search: this.search,
                },
            };

            axios.get(url, datasend).then((response) => {
                that.items = response.data.data;
                that.total_page = response.data.totalpage;
                that.total_data = response.data.total;
                that.count_start = (that.current_page - 1) * that.perpage + 1;
            });
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

        click_camera: function (index) {
            this.activeCameraId = this.cameras[index].id;
            this.scanner.start(this.cameras[index]);
        },
    },
});
