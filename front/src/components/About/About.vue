<template>
    <div class="about">
        <div id="wrapper">
            <navigation></navigation>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                About
                                <small>Info</small>
                            </h1>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="col-sm-12">
                            <button v-if="about.title" class="btn btn-danger glyphicon glyphicon-trash crudBtn"     data-toggle="modal" 
                                data-target="#delete-about">
                            </button>
                            <button v-if="about.title" class="btn btn-warning glyphicon glyphicon-pencil crudBtn" 
                                data-toggle="modal" 
                                data-target="#edit-about">
                            </button>
                            <button v-if="!about.title" class="btn btn-primary glyphicon glyphicon-plus crudBtn" 
                                data-toggle="modal" 
                                data-target="#create-about">
                            </button>
                        </div>
                        <div v-if="!about.title" class="col-sm-12">
                            <h3> {{ errorMessage }} </h3>
                        </div>
                        <div v-if="about.title" class="col-sm-12">
                            <about-title :title='about.title'></about-title>
                        </div>
                        <div v-if="about.title" class="col-sm-12">
                            <about-content :content='about.description'></about-content>
                        </div>
                        
                        <add-about :getAbout='getAbout'></add-about>

                        <edit-about :getAbout='getAbout' :about='about'></edit-about>

                        <delete-about :getAbout='getAbout' :about='about'></delete-about>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Navigation from '../Navigation.vue';
    import AboutTitle from './AboutTitle.vue';
    import AboutContent from './AboutContent.vue';
    import AddAbout from './AddAbout.vue';
    import EditAbout from './EditAbout.vue';
    import DeleteAbout from './DeleteAbout.vue';
    export default {
        name: 'About',
        components: {
            Navigation,
            AboutTitle,
            AboutContent,
            AddAbout,
            EditAbout,
            DeleteAbout
        },
        data() {
            return {
                about: {},
                errorMessage: '',
            }
        },
        created: function(){
                this.getAbout();
        },
        methods: {
            getAbout: function(page){
                this.$http.get('api/about')
                .then((response) => {
                    let results = response.body.results;
                    console.log(results);
                    if (results.error) {
                        this.errorMessage = results.error;
                        this.about = {};
                    } else {
                        this.about = results.data;
                    }
                });
            },
        }
}
</script>

<style type="text/css">
    /*@import '../../assets/css/styles.css';*/
</style>
