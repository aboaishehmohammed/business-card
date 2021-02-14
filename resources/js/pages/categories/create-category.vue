<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <b-form @submit="onSubmit">
                    <b-form-group
                        label="اسم العمل"
                    >
                        <b-form-input
                            v-model="category.name"
                            type="text"
                            required
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group label="صور الاعمال">
                        <b-form-file
                            @change="imageChanges($event)"
                            accept="image/jpeg, image/png, image/jpg"
                            multiple
                            required
                        ></b-form-file>
                    </b-form-group>

                    <b-button type="submit" variant="primary">Submit</b-button>
                </b-form>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "create-category",
    data() {

        return {
            category: {

                name: '',
                images: []
            },
        }
    },

    methods: {
        imageChanges($event) {
            let t = $event.target;
            let files = (t.files)
            console.log(files)
            this.category.images = [];
            for (let i = 0; i < files.length; i++) {

                this.category.images[i] = files[i];
            }
            console.log(this.category)
        },
        onSubmit: function (evt) {
            evt.preventDefault();
            let fd = new FormData();
            for (let i = 0; i < this.category.images.length; i++) {
                fd.append('images['+i+']', this.category.images[i]);
            }

            fd.append("name", this.category.name)
            axios.post('/adminData/categories/', fd
            )
                .then((response) => {
                    // handle success
                    console.log(response)
                    this.$router.push('/')

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {

                    // always executed
                });
        }

    },


}
</script>

<style scoped>

</style>
