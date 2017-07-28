<template>
<div class="modal fade" id="delete-about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete About</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="deleteAbout()">
                        <div class="form-group">
                            <p>Are you sure want to delete this about info ? </p>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">DELETE</button>
                            <button type="button" class="btn btn-success" data-dismiss="modal">CANCEL</button>
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
        name: 'DeleteAbout',
        components: {
        },
        methods : {
            deleteAbout: function(){
                this.$http.delete('api/about/' + this.about.id)
                .then(response => {
                    $('#delete-about').modal('hide');
                    this.getAbout();
                })
            }
        }
}
</script>