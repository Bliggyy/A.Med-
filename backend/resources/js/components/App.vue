<template>
  <div id="app">
    <div id="nav">
      <router-link v-if="authenticated" to="/login" @click.native="logout()" replace>Logout</router-link>
    </div>
    <router-view @authenticated="setAuthenticated" />
  </div>  
</template>

<script>
export default {
  name: "App",
  data() {
    return {
      authenticated: false,
      mockAccount1: {
        username: "ilovejisoo69",
        password: "password",
        type: "patient"
      },
      mockAccount2: {
        username: "lisaSoHot169",
        password: "password",
        type: "doctor"
      }
    }
    
  },
  mounted() {
    if(!this.authenticated) {
        this.$router.replace({ name: "Login" });
    }
  },
  methods: {
    setAuthenticated(status) {
          this.authenticated = status;
    },
      logout() {
          this.authenticated = false;
      }
  }
}
</script>

<style>
body {
  background-color: lightblue; 
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav router-link{
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
