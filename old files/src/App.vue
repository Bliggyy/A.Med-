<template>
  <div id="app" style="min-height: 100vh">
    <div id="nav">
      <router-link v-if="authenticated" to="/login" @click="logout()" replace>Logout</router-link>
      <router-view @authenticated="setAuthenticated" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'App',
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

#nav {
  /* padding: 30px; */
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
