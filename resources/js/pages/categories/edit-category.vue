<template>
    <div class="container">
        <b-form @submit="onSubmit">
            <b-form-group
                label="الاسم"
            >
                <b-form-input
                    v-model="category.name"
                    type="text"
                    required
                ></b-form-input>
            </b-form-group>
            <div class="d-flex justifiy-content-center" style="margin: 20px" >
                <div style="position: relative;height: 100px;margin-right: 2px" v-for="item in category.images" >
                    <img v-bind:src="'/images/'+item.id" alt="" style="height: 100px" v-if="item.id">
                    <img v-else :src="item.base64" alt="" style="height: 100px;">
                    <el-button type="danger" icon="el-icon-delete" v-on:click="destroyImage(item)"
                               style="padding:2px;height: 20px; position: absolute;top: 2px;right: 2px"></el-button>
                </div>
            </div>
            <b-form-group label="صور الاعمال" >
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


</template>

<script>
export default {
    name: "edit-category",
    data() {

        return {
            category: {},
        }
    },
    mounted() {
        axios.get('/adminData/categories/' + this.$route.params.category)
            .then((response) => {
                // handle success
                this.category = response.data

                console.log(this.category)
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    },

    methods: {
        successful() {
            this.$message({
                message: 'تم التعديل',
                type: 'success'
            });
        },
        imageChanges($event) {
            let t = $event.target;
            let files = (t.files)
            console.log(files)
            //this.category.images = [];
            for (let i = 0; i < files.length; i++) {

                this.category.images.push({
                    file: files[i],
                });
                var reader = new FileReader();
                reader.readAsDataURL(files[i]);
                reader.onloadend = () => {
                    Vue.set(this.category.images[this.category.images.length - 1], 'base64', reader.result);
                    console.log("FILE:", reader.result, this.category.images);
                }
            }
            console.log(this.category)
        },
        destroyImage(item) {
            let index = this.category.images.indexOf(item)
            this.category.images.splice(index, 1)
        },

        onSubmit: function (evt) {
            evt.preventDefault();
            let fd = new FormData();
            for (let i = 0; i < this.category.images.length; i++) {
                if(this.category.images[i].id){
                    fd.append('images['+i+']', this.category.images[i].id);}
                else{
                    fd.append('images['+i+']', this.category.images[i].file);
                }
            }
            fd.append("name", this.category.name)
            axios.post('/adminData/categories/' + this.$route.params.category, fd
            )
                .then((response) => {
                    // handle success
                    console.log(response)
                    this.successful();
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
