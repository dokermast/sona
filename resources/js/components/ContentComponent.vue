<template>

    <div class="container content">
        <div class="row">

            <div class="col-sm-4">
                <div class="container">
                    <div class="">
                        <h3>FILTER</h3>
                        <br>
                        <div class="form-group">

                            <h5>Тип обложки</h5>

                            <div class="form-check">
                                <input v-model="filter.cover" class="form-check-input" type="radio" name="cover" value="1">
                                <label class="form-check-label">Soft</label>
                            </div>
                            <div class="form-check">
                                <input v-model="filter.cover" class="form-check-input" type="radio" name="cover" value="0">
                                <label class="form-check-label">Hard</label>
                            </div>
                            <div class="form-check">
                                <input v-model="filter.cover" class="form-check-input" type="radio" name="cover" value="2">
                                <label class="form-check-label">All types</label>
                            </div>
                            <br>

                            <h5>Категории книг</h5>

                            <div class="form-check">
                                <input v-model="filter.category" class="form-check-input" type="checkbox" value="1">
                                <label class="form-check-label">Sport</label>
                            </div>
                            <div class="form-check">
                                <input v-model="filter.category" class="form-check-input" type="checkbox" value="2">
                                <label class="form-check-label">Sience</label>
                            </div>
                            <div class="form-check">
                                <input v-model="filter.category" class="form-check-input" type="checkbox" value="3">
                                <label class="form-check-label">Cinema</label>
                            </div>
                            <div class="form-check">
                                <input v-model="filter.category" class="form-check-input" type="checkbox" value="4">
                                <label class="form-check-label">Crime</label>
                            </div>
                            <div class="form-check">
                                <input v-model="filter.category" class="form-check-input" type="checkbox" value="5">
                                <label class="form-check-label">Art</label>
                            </div>
                            <br>
                            <button @click="choose">Choose</button>
                            <br>
                            <br>
                            <button @click="resetFilter">Reset Filter</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="container">
                    <div class="text-center"><h3>BOOKS</h3></div>
                    <div class="container">
                        <div class="container-fluid">
                            <div class="row">
                                <div v-for="item in books" class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body" >
                                            <h5 class="card-title"><span style="color:deepskyblue">Title: </span><span>{{ item.title }}</span></h5>
                                            <h5 class="card-title"><span style="color:deepskyblue">Category: </span><span>{{ item.category.name }}</span></h5>
                                            <h5 v-if="item.paperback" class="card-title"><span style="color:deepskyblue">Cover type: </span><span>soft</span></h5>
                                            <h5 v-else class="card-title"><span style="color:deepskyblue">Cover type: </span><span>hard</span></h5>
                                            <h5 class="card-title"><span style="color:deepskyblue">Price: </span><span>{{ item.price }}</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "ContentComponent",
        data(){
            return {
                filter: {
                    category: [],
                    cover: ''
                },
                categories: '',
                books_url: '/sona/books',
                choose_url: '/sona/choose',
                books: '',
            }
        },
        mounted(){
            this.getBooks();
        },
        methods: {
            choose(){
                axios.post(this.choose_url,{
                    'filter': this.filter,
                }).then((response) => {
                    console.log(response.data);
                    this.books = '';
                    this.books=response.data.books;
                })
            },
            getBooks(){
                axios.get(this.books_url).then((response) => {
                    this.books = response.data.books;
                    this.categories = response.data.categories;
                })
            },
            resetFilter(){
                this.filter.category = [];
                this.filter.cover = '';
                this.books = '';
                this.getBooks();
            }
        }
    }
</script>

<style scoped>

    .content {
        margin-top: 70px;
    }

</style>
