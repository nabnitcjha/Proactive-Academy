<template>
       <div
            class="modal fade modal-tall slot-modal"
            id="deleteModal"
            tabindex="-1"
            aria-labelledby="deleteModalLabel"
            aria-hidden="true"
            v-if="showDeleteModel"
        >
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">
                            Slot Detail
                        </h1>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <!-- start body -->
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between"
                            >
                                <span>Assignment</span>
                            </div>
                           
                           
                        </div>

                        <!-- end body -->
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            @click.stop="modalClose"
                        >
                            Close
                        </button>
                        <button type="button" class="btn btn-primary"
                        @click.stop="deleteData"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
import "./DeleteModal.css";
export default {
    props: {
        showDeleteModel: Boolean,
        userType: String,
    },
    methods:{
        deleteData(){
             this.$emit('confirm-delete');
        },
        modalClose(){
             this.$emit('close-modal');
        }
    }
};
</script>
