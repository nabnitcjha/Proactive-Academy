export default {
    data() {
        return {};
    },
    methods: {
        deleteAlert(id, type) {
            // Use sweetalert2
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    // imageUrl: 'https://media3.giphy.com/media/VD4Bt6FyYWcWj0LzDK/giphy.gif?cid=ecf05e474e7l1aq7styn2ewhpwhb551w672171bduai3ppol&rid=giphy.gif&ct=g',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: "Custom image",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        if (type == "calendar") {
                            this.$root.deleteFile(id);
                            this.getResourceFile();
                        }
                        this.$swal.fire(
                            "Deleted!",
                            "Your file has been deleted.",
                            "success"
                        );
                    }
                });
        },
        saveAlert(msg) {
            // Use sweetalert2
            this.$swal.fire({
                position: "top-end",
                icon: "success",
                title: msg,
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
            });
        },

        errorAlert(msg) {
            // Use sweetalert2
            this.$swal.fire({
                position: "top-end",
                icon: "warning",
                title: msg,
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
            });
        },
        classErrorAlert(msg, htmlMsg) {
            // Use sweetalert2
            this.$swal.fire({
                position: "top-end",
                icon: "warning",
                title: msg,
                html: "<div class='class-error mt-3'>" + htmlMsg + "</div>",
                showConfirmButton: false,
                timer: 7500,
                timerProgressBar: true,
            });
        },
        select_badge() {
            let badges = [
                "text-success",
                "text-danger",
                "text-primary",
                "text-info",
                "text-warning",
                "text-muted",
            ];
            let selected_badge =
                badges[Math.floor(Math.random() * badges.length)];

            return selected_badge;
        },
    },
};
