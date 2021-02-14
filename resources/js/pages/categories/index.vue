<template>
    <div>
        <div class="card">
            <div class="card-header">

                <h2 class="text-center">الاعمال</h2>
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

                    <tr v-for="(item,index) in categories" v-if="categories" :key="item.name">
                        <th scope="row">{{ index + 1 }}</th>
                        <td>{{ item.name }}</td>
                        <td><img v-bind:src="'/images/'+item.images[0].id" alt="" style="width: 80px"></td>
                        <td>
                            <router-link :to="{ path: '/edit-category/'+item.id}">
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
    </div>
</template>

<script>
export default {
    name: "index-categories",
    data() {
        return {
            category: 'mohammed',
            categories: []
        }
    },
    mounted() {
        axios.get('/adminData/categories/')
            .then((response) => {
                // handle success
                this.categories = response.data
                console.log(this.categories)
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
        destroy(item) {
            axios.delete('/adminData/categories/' + item.id)
                .then((response) => {
                    // handle success
                    let index = this.categories.indexOf(item)
                    this.categories.splice(index, 1)
                    console.log(this.categories)
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
