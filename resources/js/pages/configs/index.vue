<template>
    <div>
        <div class="card">
            <div class="card-header">

                <h2 class="text-center">اعدادات</h2>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم</th>
                        <th scope="col">صورة</th>
                        <th scope="col">تعديل</th>
                        <th scope="col">حذف</th>

                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="(item,index) in configs" v-if="configs" :key="index">
                        <th scope="row">{{ index + 1 }}</th>
                        <td>{{ item.name }}</td>
                        <td><img v-bind:src="'/images/'+item.logo" alt="" style="width: 80px"></td>
                        <td>
                            <router-link :to="{ path: '/edit-config/'+item.id}">
                                <el-button type="success" icon="el-icon-s-order">تعديل
                                </el-button>
                            </router-link>
                        </td>

                        <td>
                            <el-button type="danger" icon="el-icon-delete" v-on:click="destroy(item)">حذف</el-button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="card">
            <div class="card-header">

                <h2 class="text-center">اعدادات</h2>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اللون الاول</th>
                        <th scope="col">اللون الثاني</th>
                        <th scope="col">اللون الثالث</th>
                        <th scope="col">اللون الرابع</th>
                        <th scope="col">حذف</th>

                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="(item,index) in themes" v-if="themes" :key="index">
                        <th scope="row">{{ index + 1 }}</th>
                        <td :style="'background-color:'+item.first_color"></td>
                        <td :style="'background-color:'+item.second_color"></td>
                        <td :style="'background-color:'+item.third_color"></td>
                        <td :style="'background-color:'+item.fourth_color"></td>
                        <td>
                            <router-link :to="{ path: '/edit-theme/'+item.id}">
                                <el-button type="success" icon="el-icon-s-order">تعديل
                                </el-button>
                            </router-link>
                        </td>

                        <td>
                            <el-button type="danger" icon="el-icon-delete" v-on:click="destroyTheme(item)">حذف</el-button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</template>

<script>
export default {
    name: "index-configs",
    data() {
        return {
            configs: [],
            themes:[]
        }
    },
    mounted() {
        axios.get('/adminData/configs/')
            .then((response) => {
                // handle success
                this.configs= response.data
                console.log(this.configs)
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });

        axios.get('/adminData/theme-configs/')
            .then((response) => {
                // handle success
                this.themes= response.data
                console.log(this.themes)
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            })

        ;
    },
    methods: {
        destroy(item) {
            axios.delete('/adminData/configs/' + item.id)
                .then((response) => {
                    // handle success
                    let index = this.configs.indexOf(item)
                    this.configs.splice(index, 1)
                    console.log(this.configs)
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
        },
        destroyTheme(item) {
            axios.delete('/adminData/theme-configs/' + item.id)
                .then((response) => {
                    // handle success
                    let index = this.themes.indexOf(item)
                    this.themes.splice(index, 1)
                    console.log(this.themes)
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
