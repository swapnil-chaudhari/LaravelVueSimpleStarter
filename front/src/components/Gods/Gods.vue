<template>
    <div class="gods">
        <div id="wrapper">
            <navigation></navigation>

            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Gods
                                <small>List</small>
                            </h1>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <button class="btn btn-primary addBtn" data-toggle="modal" data-target="#create-god">ADD</button>

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
                                    <tr v-for = 'god in gods'>
                                        <td> {{ god.id }} </td>
                                        <td> {{ god.name }} </td>
                                        <td> {{ god.description }} </td>
                                        <td>
                                            <button class="btn btn-warning" @click.prevent="editGod(god)">EDIT</button>
                                            <button class="btn btn-danger" @click.prevent="deleteGodModal(god)">DELETE</button>
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
                   <div class="modal fade" id="create-god" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                     <div class="modal-dialog" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                           <h4 class="modal-title" id="myModalLabel">Create God</h4>
                         </div>
                         <div class="modal-body">
                               <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createGod">

                                   <div class="form-group">
                                   <label for="name">Name:</label>
                                   <input type="text" name="name" class="form-control" v-model="newGod.name" />
                                   <span v-if="formErrors['name']" class="error text-danger">{{ formErrors['name'] }}</span>
                               </div>

                               <div class="form-group">
                                   <label for="title">Description:</label>
                                   <textarea name="description" class="form-control" v-model="newGod.description"></textarea>
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
                        <div class="modal fade" id="edit-god" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit God</h4>
                              </div>
                              <div class="modal-body">

                                    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateGod(fillGod.id)">

                                        <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" class="form-control" v-model="fillGod.name" />
                                        <span v-if="formErrorsUpdate['name']" class="error text-danger">{{ formErrorsUpdate['name'] }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Description:</label>
                                        <textarea name="description" class="form-control" v-model="fillGod.description"></textarea>
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
                                <div class="modal fade" id="delete-god" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Delete God</h4>
                                      </div>
                                      <div class="modal-body">

                                            <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="deleteGod(fillDeleteGod.id)">

                                                <div class="form-group">
                                                    <p>Are you sure want to delete this God ? </p>
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
        name: 'Gods',
        components: {
            Navigation
        },
        data () {
              return {
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
                   newGod : {'name':'','description':''},
                   fillGod : {'name':'','description':'','id':''},
                   fillDeleteGod : { 'id' : ''}
               }
        },
        created : function(){
        		this.getGods(this.pagination.current_page);
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

            getGods: function(page){
                this.$http.get('api/gods?page='+page).then((response) => {
                    this.gods = response.body.data.data
                    this.pagination = response.body.pagination
                });
            },
            createGod: function(){
                var input = this.newGod;
        		this.$http.post('api/gods',input).then((response) => {
            		this.changePage(this.pagination.current_page);
            		this.newGod = {'title':'','description':''};
            		$("#create-god").modal('hide');
                    this.newGod = [];
        		}, (response) => {
        		    this.formErrors = response.data;
        	    });
        	},
            editGod: function(god){
                 this.fillGod.name = god.name;
                 this.fillGod.id = god.id;
                 this.fillGod.description = god.description;
                 $("#edit-god").modal('show');
             },
             updateGod: function(id){
                var input = this.fillGod;
                this.$http.put('api/gods/'+id,input).then((response) => {
                    this.changePage(this.pagination.current_page);
                    this.fillGod = {'name':'','description':'','id':''};
                    $("#edit-god").modal('hide');
                  }, (response) => {
                      this.formErrorsUpdate = response.data;
                  });
              },
              deleteGodModal: function(god){
                   this.fillDeleteGod.id = god.id;
                   $("#delete-god").modal('show');
               },
               deleteGod: function(id){
                   this.$http.delete('api/gods/'+id).then((response) => {
                       this.changePage(this.pagination.current_page);
                       this.fillDeleteGod = {'id':''};
                       $("#delete-god").modal('hide');
                     }, (response) => {

                     });
                },
                closeDeleteModal : function (){
                    $("#delete-god").modal('hide');
                },
                changePage: function (page) {
                    this.pagination.current_page = page;
                    this.getGods(page);
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
