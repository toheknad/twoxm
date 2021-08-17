<template>
  <v-container>
    <v-row xs={12}>
      <v-col  class="login flex-center">
        <form @submit.prevent="submit">
          <h2 class="login-title ">Привет, снова<span class="login-title-smile">;)</span></h2>
          <h5 class="login-subtitle text-center">Введите ваши данные, чтобы войти</h5>

          <div class="form-floating mb-3">
            <v-text-field
                v-model="form.email"
                label="E-mail"
                required
            ></v-text-field>
          </div>

          <div class="form-floating mb-3">
            <v-text-field
                v-model="form.password"
                :counter="20"
                label="Пароль"
                type="password"
                required
            ></v-text-field>
          </div>

          <div>
            <button class='default-button'>
              <span>Войти</span>
            </button>
          </div>

          <div class="mt-1">
            <router-link  to="/register" class="default-button-outline  login-margin">Зарегистрироваться</router-link>
          </div>

        </form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";

export default {

  name: "Login",
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      showError: false
    };
  },
  methods: {
    ...mapActions(["LogIn"]),
    async submit() {
      const User = new FormData();
      User.append("email", this.form.email);
      User.append("password", this.form.password);
      try {
        await this.LogIn(User);
        this.$router.push("/dashboard");
        this.showError = false
      } catch (error) {
        this.showError = true
        console.log(error)
      }
    },
  },
}
</script>

<style scoped>

</style>