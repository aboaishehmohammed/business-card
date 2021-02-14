<template>
    <table class="table table-hover" v-if="item">
        <tr>
            <td>#</td>
            <td>name</td>
            <td>image</td>
        </tr>
        <tr >
            <td>{{ item.id }}</td>

                <td>{{ item.name }}</td>
            <td ><img v-bind:src="'/images/'+item.image_id" alt="" style="width: 80px; height: 50px"></td>
        </tr>
    </table>
</template>

<script>
export default {
    name: "category-details",
    data() {
        return {
            item: null,
        }
    },
    mounted() {
        axios.get('/adminData/categories/' + this.$route.params.category)
            .then((response) => {
                // handle success
                this.item = response.data
                console.log(this.item)
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
</script>

<style scoped>

</style>
