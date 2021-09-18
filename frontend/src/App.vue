<template>
  <div id="app">
    <v-app>
      <div id="nav">
        <router-link  class="navbar-link" to="/">Главная</router-link> |
        <span v-if="isLoggedIn">
          <router-link class="navbar-link" to="/dashboard">Дашборд</router-link> |
          <a  class="navbar-link" @click="logout">Выйти</a>
        </span>
        <span v-else>
        <router-link class="navbar-link" to="/login">Вход</router-link> |
        <router-link class="navbar-link" to="/register">Регистрация</router-link>
        </span>
      </div>
      <router-view/>
    </v-app>
  </div>
</template>
<script>
export default {
  name: 'App',
  computed : {
    isLoggedIn : function(){ return this.$store.getters.isAuthenticated}
  },
  methods: {
    async logout (){
      await this.$store.dispatch('logout')
      this.$router.push('/login')
    }
  },
}
</script>
<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
