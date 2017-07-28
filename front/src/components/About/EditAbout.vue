<template>
    <div class="modal fade" id="edit-about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit About</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="editAbout">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" v-model="about.title" />
                            
                        </div>
                        <div class="form-group">
                            <label for="title">Description:</label>
                            <textarea name="editor2" id="editor2" class="form-control ckeditor">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'getAbout',
            'about',
        ],
        name: 'EditAbout',
        components: {
        },
        updated : function(){
        	let description = this.about.description;
        	CKEDITOR.on('instanceReady', function(evt){
            		CKEDITOR.instances.editor2.setData(description);
		    });
        },
        methods : {
            editAbout: function(){
            	this.about.description =  CKEDITOR.instances.editor2.getData();
            	this.$http.put('api/about/' + this.about.id, this.about)
                .then(response => {
                    $('#edit-about').modal('hide');
                    this.getAbout();
                })
            }
        }
}
</script>