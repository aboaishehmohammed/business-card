<template>
    <div class="container">
        <b-form @submit="onSubmit">
            <b-form-group
                label="الاسم"
            >
                <b-form-input
                    v-model="config.name"
                    type="text"
                    required
                ></b-form-input>
            </b-form-group>

            <b-form-group label="صورة" >
                <b-form-file
                    @change="imageChanges($event)"
                    accept="image/jpeg, image/png, image/jpg"
                    required
                ></b-form-file>
                <div style="width: 100px;height: 100px; position: relative;margin-top: 5px" v-if="config.logo" >
                    <img v-bind:src="config.base64"  alt="" style="height: 100px;" v-if="config.base64">
                    <img  alt=""  v-bind:src="'/images/'+config.logo" style="height: 100px;" v-else>
                </div>
            </b-form-group>

            <b-button type="submit" variant="primary">اختيار</b-button>
        </b-form>
    </div>

</template>

<script>
export default {
    name: "edit-configs",
    data() {

        return {
            config: {},
        }
    },
    mounted() {
        axios.get('/adminData/configs/' + this.$route.params.config)
            .then((response) => {
                // handle success
                this.config = response.data

                console.log(this.config)
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    },
    methods:{
        imageChanges($event) {
            let t = $event.target;
            let files = (t.files)
            console.log(files)
            //this.category.images = [];
            this.config.logo=files[0]
            console.log(this.config.logo);
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = () => {
                Vue.set(this.config, 'base64', reader.result);
                console.log("FILE:", reader.result, this.config);
            }

            console.log(this.config)
        },
        successful() {
            this.$message({
                message: 'تم التعديل',
                type: 'success',
            });
        },

        onSubmit: function (evt) {
            evt.preventDefault();
            let fd = new FormData();
            fd.append("logo", this.config.logo);
            fd.append("name", this.config.name)
            axios.post('/adminData/configs/' + this.$route.params.config, fd
            )
                .then((response) => {
                    // handle success
                    console.log(response)
                    this.successful()
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
    }

}
</script>

<style scoped>

</style>
