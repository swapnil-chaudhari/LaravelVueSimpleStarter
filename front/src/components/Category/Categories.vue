<template>
    <div class="categories">
        <div id="wrapper">
            <navigation></navigation>

            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Category
                                <small>List</small>
                            </h1>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <button class="btn btn-primary addBtn" data-toggle="modal" data-target="#create-category">ADD</button>

                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th id="thDescription">Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for = 'category in categories'>
                                        <td> {{ category.id }} </td>
                                        <td> {{ category.name }} </td>
                                        <td> {{ category.description }} </td>
                                        <td>
                                            <button class="btn btn-warning" @click.prevent="editCategory(category)">EDIT</button>
                                            <button class="btn btn-danger" @click.prevent="deleteCategoryModal(category)">DELETE</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <!-- /.row -->

                    <!-- Pagination -->
            		<nav>
            	        <ul class="pagination">
            	            <li v-if="pagination.current_page > 1">
            	                <a href="#" aria-label="Previous"
            	                   @click.prevent="changePage(pagination.current_page - 1)">
            	                    <span aria-hidden="true">«</span>
            	                </a>
            	            </li>
            	            <li v-for="page in pagesNumber"
            	                v-bind:class="[ page == isActived ? 'active' : '']">
            	                <a href="#"
            	                   @click.prevent="changePage(page)">{{ page }}</a>
            	            </li>
            	            <li v-if="pagination.current_page < pagination.last_page">
            	                <a href="#" aria-label="Next"
            	                   @click.prevent="changePage(pagination.current_page + 1)">
            	                    <span aria-hidden="true">»</span>
            	                </a>
            	            </li>
            	        </ul>
            	    </nav>
                </div>
                <!-- /.container-fluid -->

                <!-- Create category Modal -->
                   <div class="modal fade" id="create-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                     <div class="modal-dialog" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                           <h4 class="modal-title" id="myModalLabel">Create Category</h4>
                         </div>
                         <div class="modal-body">
                               <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createCategory">

                                   <div class="form-group">
                                   <label for="name">Name:</label>
                                   <input type="text" name="name" class="form-control" v-model="newCategory.name" />
                                   <span v-if="formErrors['name']" class="error text-danger">{{ formErrors['name'] }}</span>
                               </div>

                               <div class="form-group">
                                   <label for="title">Description:</label>
                                   <textarea name="description" class="form-control" v-model="newCategory.description"></textarea>
                                   <span v-if="formErrors['description']" class="error text-danger">{{ formErrors['description'] }}</span>
                               </div>

                               <div class="form-group">
                                   <button type="submit" class="btn btn-success">SAVE</button>
                               </div>

                               </form>


                         </div>
                       </div>
                     </div>
                   </div>

                <!-- Edit category Modal -->
                        <div class="modal fade" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
                              </div>
                              <div class="modal-body">

                                    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateCategory(fillCategory.id)">

                                        <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" class="form-control" v-model="fillCategory.name" />
                                        <span v-if="formErrorsUpdate['name']" class="error text-danger">{{ formErrorsUpdate['name'] }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Description:</label>
                                        <textarea name="description" class="form-control" v-model="fillCategory.description"></textarea>
                                        <span v-if="formErrorsUpdate['description']" class="error text-danger">{{ formErrorsUpdate['description'] }}</span>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">UPDATE</button>
                                    </div>

                                    </form>

                              </div>
                            </div>
                          </div>
                        </div>


                        <!-- Delete category Modal -->
                                <div class="modal fade" id="delete-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Delete Category</h4>
                                      </div>
                                      <div class="modal-body">

                                            <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="deleteCategory(fillDeleteCategory.id)">

                                                <div class="form-group">
                                                    <p>Are you sure want to delete this Category ? </p>
                                                </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">DELETE</button>
                                                <button type="button" @click.prevent="closeDeleteModal()" class="btn btn-success">CANCEL</button>
                                            </div>

                                            </form>

                                      </div>
                                    </div>
                                  </div>
                                </div>

            </div>

        </div>
    </div>
</template>

<script>
    import Navigation from '../Navigation.vue';
    export default {
        name: 'Categories',
        components: {
            Navigation
        },
        data () {
              return {
                  categories: [],
                  pagination: {
                       total: 0,
                       per_page: 2,
                       from: 1,
                       to: 0,
                       current_page: 1
                     },
                   offset: 4,
                   formErrors:{},
                   formErrorsUpdate:{},
                   newCategory : {'name':'','description':''},
                   fillCategory : {'name':'','description':'','id':''},
                   fillDeleteCategory : { 'id' : ''}
               }
        },
        created : function(){
        		this.getCategories(this.pagination.current_page);
        },
        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods : {

            getCategories: function(page){
                this.$http.get('api/categories?page='+page).then((response) => {
                    this.categories = response.body.data.data
                    this.pagination = response.body.pagination
                    // this.$set('pagination', response.body.pagination);

                });
            },
            createCategory: function(){
                var input = this.newCategory;
        		this.$http.post('api/categories',input).then((response) => {
            		this.changePage(this.pagination.current_page);
            		this.newCategory = {'title':'','description':''};
            		$("#create-category").modal('hide');
            		toastr.success('Category Created Successfully.', 'Success Alert', {timeOut: 5000});
        		}, (response) => {
        		    this.formErrors = response.data;
        	    });
        	},
            editCategory: function(category){
                 this.fillCategory.name = category.name;
                 this.fillCategory.id = category.id;
                 this.fillCategory.description = category.description;
                 $("#edit-category").modal('show');
             },
             updateCategory: function(id){
                var input = this.fillCategory;
                this.$http.put('api/categories/'+id,input).then((response) => {
                    this.changePage(this.pagination.current_page);
                    this.fillCategory = {'name':'','description':'','id':''};
                    $("#edit-category").modal('hide');
                  }, (response) => {
                      this.formErrorsUpdate = response.data;
                  });
              },
              deleteCategoryModal: function(category){
                   this.fillDeleteCategory.id           = category.id;
                   $("#delete-category").modal('show');
               },
               deleteCategory: function(id){
                   this.$http.delete('api/categories/'+id).then((response) => {
                       this.changePage(this.pagination.current_page);
                       this.fillDeleteCategory = {'id':''};
                       $("#delete-category").modal('hide');
                     }, (response) => {

                     });
                },
                closeDeleteModal : function (){
                    $("#delete-category").modal('hide');
                },
                changePage: function (page) {
                    this.pagination.current_page = page;
                    this.getCategories(page);
                }

        }


    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .addBtn { float : right; padding-left: 20px;padding-right: 20px;margin-bottom: 10px;}
    h1,
    h2 {
        font-weight: normal;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        display: inline-block;
        margin: 0 10px;
    }
    a {
        color: #42b983;
    }
    #thDescription {
        width: 70%;
    }
</style>
