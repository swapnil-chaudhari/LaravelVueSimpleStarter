<template>
    <div class="sangrahs">
        <div id="wrapper">
            <navigation></navigation>

            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Sangrahs
                                <small>List</small>
                            </h1>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <button class="btn btn-primary addBtn" data-toggle="modal" data-target="#create-sangrah">ADD</button>

                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>God</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for = 'sangrah in sangrahs'>
                                        <td> {{ sangrah.id }} </td>
                                        <td> {{ sangrah.god.name }} </td>
                                        <td> {{ sangrah.category.name }} </td>
                                        <td> {{ sangrah.name }} </td>
                                        <td> {{ sangrah.description }} </td>
                                        <td>
                                            <button class="btn btn-warning" @click.prevent="editSangrah(sangrah)">EDIT</button>
                                            <button class="btn btn-danger" @click.prevent="deleteSangrahModal(sangrah)">DELETE</button>
                                    </tr>
                                </td>
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
                   <div class="modal fade" id="create-sangrah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                     <div class="modal-dialog" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                           <h4 class="modal-title" id="myModalLabel">Create Sangrah</h4>
                         </div>
                         <div class="modal-body">
                               <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createSangrah">

                                   <div class="form-group">
                                       <label for="name">Name:</label>
                                       <input type="text" name="name" class="form-control" v-model="newSangrah.name" />
                                       <span v-if="formErrors['name']" class="error text-danger">{{ formErrors['name'] }}</span>
                                   </div>

                                   <div class="form-group">
                                       <label for="title">Description:</label>
                                       <textarea name="description" class="form-control" v-model="newSangrah.description"></textarea>
                                       <span v-if="formErrors['description']" class="error text-danger">{{ formErrors['description'] }}</span>
                                   </div>

                                   <div class="form-group">
                                       <label for="name">God/Goddes:</label>
                                       <select v-model="newSangrah.god_id" class="form-control">
                                            <option disabled>Select...</option>
                                            <option v-for="god in gods" :value="god.id">{{ god.name }}</option>
                                        </select>
                                       <span v-if="formErrors['god_id']" class="error text-danger">{{ formErrors['god_id'] }}</span>
                                   </div>

                                   <div class="form-group">
                                       <label for="name">Category:</label>
                                       <select v-model="newSangrah.category_id" class="form-control">
                                            <option disabled>Select...</option>
                                            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                        </select>
                                       <span v-if="formErrors['category_id']" class="error text-danger">{{ formErrors['category_id'] }}</span>
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
                        <div class="modal fade" id="edit-sangrah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit Sangrah</h4>
                              </div>
                              <div class="modal-body">

                                    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateSangrah(fillSangrah.id)">

                                        <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" class="form-control" v-model="fillSangrah.name" />
                                        <span v-if="formErrorsUpdate['name']" class="error text-danger">{{ formErrorsUpdate['name'] }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Description:</label>
                                        <textarea name="description" class="form-control" v-model="fillSangrah.description"></textarea>
                                        <span v-if="formErrorsUpdate['description']" class="error text-danger">{{ formErrorsUpdate['description'] }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">God/Goddes:</label>
                                        <select v-model="fillSangrah.god_id" class="form-control">
                                             <option disabled>Select...</option>
                                             <option v-for="god in gods" :value="god.id">{{ god.name }}</option>
                                         </select>
                                        <span v-if="formErrorsUpdate['god']" class="error text-danger">{{ formErrorsUpdate['god'] }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Category:</label>
                                        <select v-model="fillSangrah.category_id" class="form-control">
                                             <option disabled>Select...</option>
                                             <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                         </select>
                                        <span v-if="formErrorsUpdate['category']" class="error text-danger">{{ formErrorsUpdate['category'] }}</span>
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
                                <div class="modal fade" id="delete-sangrah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Delete Sangrah</h4>
                                      </div>
                                      <div class="modal-body">

                                            <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="deleteSangrah(fillDeleteSangrah.id)">

                                                <div class="form-group">
                                                    <p>Are you sure want to delete this Sangrah ? </p>
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
        name: 'Sangrahs',
        components: {
            Navigation
        },
        data () {
              return {
                  sangrahs: [],
                  categories: [],
                  gods: [],
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
                   newSangrah : {'name':'','description':'', 'god_id' : '', 'category_id' : ''},
                   fillSangrah : {'name':'','description':'','god_id' : '', 'category_id' : '', 'id':''},
                   fillDeleteSangrah : { 'id' : ''}
               }
        },
        created : function(){
        		this.getSangrahs(this.pagination.current_page);
                this.getGods();
                this.getCategories();
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

            getSangrahs: function(page){
                this.$http.get('api/sangrahs?page='+page).then((response) => {
                    this.sangrahs = response.body.data.data
                    this.pagination = response.body.pagination

                });
            },
            createSangrah: function(){
                var input = this.newSangrah;
        		this.$http.post('api/sangrahs',input).then((response) => {
            		this.changePage(this.pagination.current_page);
            		this.newSangrah = {'title':'','description':''};
            		$("#create-sangrah").modal('hide');
                    this.newSangrah = [];
        		}, (response) => {
        		    this.formErrors = response.data;
        	    });
        	},
            editSangrah: function(sangrah){
                 this.fillSangrah.name = sangrah.name;
                 this.fillSangrah.id = sangrah.id;
                 this.fillSangrah.description = sangrah.description;
                 this.fillSangrah.category_id = sangrah.category_id;
                 this.fillSangrah.god_id = sangrah.god_id;
                 $("#edit-sangrah").modal('show');
             },
             updateSangrah: function(id){
                var input = this.fillSangrah;
                this.$http.put('api/sangrahs/'+id,input).then((response) => {
                    this.changePage(this.pagination.current_page);
                    this.fillSangrah = {'name':'','description':'','id':''};
                    $("#edit-sangrah").modal('hide');
                  }, (response) => {
                      this.formErrorsUpdate = response.data;
                  });
              },
              deleteSangrahModal: function(sangrah){
                   this.fillDeleteSangrah.id = sangrah.id;
                   $("#delete-sangrah").modal('show');
               },
               deleteSangrah: function(id){
                   this.$http.delete('api/sangrahs/'+id).then((response) => {
                       this.changePage(this.pagination.current_page);
                       this.fillDeleteSangrah = {'id':''};
                       $("#delete-sangrah").modal('hide');
                     }, (response) => {

                     });
                },
                closeDeleteModal : function (){
                    $("#delete-sangrah").modal('hide');
                },
                changePage: function (page) {
                    this.pagination.current_page = page;
                    this.getSangrahs(page);
                },
                getCategories: function(){
                    this.$http.get('api/categoriesList').then((response) => {
                        this.categories = response.body
                    });
                },
                getGods: function(){
                    this.$http.get('api/godsList').then((response) => {
                        this.gods = response.body
                    });
                },

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
