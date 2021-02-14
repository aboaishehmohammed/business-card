<template>
    <div class="container">
        <el-form ref="form" @submit="onSubmit">
            <div >
                <span class="demonstration">اللون الاول</span>
                <el-color-picker v-model="theme.first_color" ></el-color-picker>
            </div>
            <div >
                <span class="demonstration">اللون الثاني</span>
                <el-color-picker v-model="theme.second_color" ></el-color-picker>
            </div>
            <div class="block">
                <span class="demonstration">اللون الثالث</span>
                <el-color-picker v-model="theme.third_color" ></el-color-picker>
            </div>
            <div class="block">
                <span class="demonstration">اللون الرابع</span>
                <el-color-picker v-model="theme.fourth_color" ></el-color-picker>
            </div>
            <el-button type="primary" @click="onSubmit">اضافة</el-button>

        </el-form>
    </div>

</template>

<script>
export default {
    name: "create-theme",
    data() {

        return {
            theme: {
                first_color: null,
                second_color: null,
                third_color: null,
                fourth_color: null,

            },
        }
    },
    methods: {


        onSubmit: function (evt) {
            evt.preventDefault();

            axios.post('/adminData/theme-configs/', this.theme
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
    }
}
</script>

<style scoped>

</style>
