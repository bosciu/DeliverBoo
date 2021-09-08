<template>
    <div
        class="modal fade"
        id="dishModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ dish.name }}
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

                <div class="modal-body">
                    <div class="img-container">
                        <img
                            :src="'/storage/' + dish.img_path"
                            :alt="dish.name"
                        />
                    </div>
                    <p>
                        {{ dish.desc }}
                    </p>
                    <div class="row justify-content-center">
                        <div class="col-3 quantity">
                            <span class="button-container">
                                <i class="fas fa-minus"></i>
                            </span>
                            <span>1</span>
                            <span class="button-container">
                                <i class="fas fa-plus"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Chiudi
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ShowDishModal",
    props: {
        dish: Object
    }
};
</script>

<style scoped lang="scss">
#dishModal {
    .img-container {
        width: 100%;
        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
    }
    p {
        padding: 20px 20px 0;
        text-align: center;
        word-break: break-all;
    }
}
</style>
