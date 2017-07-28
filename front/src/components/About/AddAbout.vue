<template>
    <div class="modal fade" id="create-about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create About</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createAbout">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" v-model="about.title" />
                            
                        </div>
                        <div class="form-group">
                            <label for="title">Description:</label>
                            <textarea name="editor1" id="editor1" class="form-control ckeditor">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // import '../../assets/js/ckeditor.js';
    
    export default {
        props: [
            'getAbout'
        ],
        name: 'AddAbout',
        components: {
        },
        data () {
              return {
                  about: {
                    title: '',
                    description: '',
                  },
               }
        },
        created : function(){
        },
        computed: {
        },
        methods : {
            createAbout: function(){
                this.about.description =  CKEDITOR.instances.editor1.getData();
                this.$http.post('api/about', this.about)
                .then(response => {
                    $('#create-about').modal('hide');
                    this.getAbout();
                })
            }
        }


    }
</script>