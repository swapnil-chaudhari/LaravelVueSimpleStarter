<template lang="html">
    <div class="container">

      <form class="form-signin">
            <h2 class="form-signin-heading">Login</h2>
            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" v-model="email" class="form-control" placeholder="Email" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" v-model="password" class="form-control" placeholder="Password" required="">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div>
            <button @click="test" class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>

    </div>
</template>

<script>
export default {
    data () {
        return {
            email    : 'connect@swapnilchaudhari',
            password : '123'
        }
    },
    methods: {
        test (){
            var data = {
                client_id : '2',
                client_secret : '',
                grant_type : 'password',
                username : this.email,
                password : this.password
            }

            this.$http.post("http://127.0.0.1:8000/oauth/token")
            .then(response => {
                console.log(response)
            })
            // .then(function(response){
            //     console.log(response)
            // })
        }
    }
}
</script>

<style lang="css">
.form-signin {
max-width: 330px;
padding: 15px;
margin: 0 auto;
}
</style>
