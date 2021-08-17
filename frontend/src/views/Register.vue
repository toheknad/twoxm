<template>
  <v-container>
    <v-row xs={12}>
      <v-col  class="login flex-center">
          <form @submit.prevent="submit">
            <h2 class="login-title text-center">Регистрация аккаунта</h2>
            <h5 class="login-subtitle text-center">Присоединитесь прямо сейчас, чтобы получить<br/> доступ ко всем функциям на сайте</h5>

            <div class="form-floating mb-3">
              <v-text-field
                  v-model="form.email"
                  label="E-mail"
                  required
              ></v-text-field>
            </div>

<!--            <div class="form-floating mb-3">-->
<!--              <v-text-field-->
<!--                  v-model="firstname"-->
<!--                  :rules="nameRules"-->
<!--                  :counter="15"-->
<!--                  label="Логин"-->
<!--              ></v-text-field>-->
<!--            </div>-->

            <div class="form-floating mb-3">
              <v-text-field
                  v-model="form.password"
                  :counter="20"
                  label="Пароль"
                  type="password"
                  required
              ></v-text-field>
            </div>

<!--            <div class="form-floating mb-3">-->
<!--              <v-text-field-->
<!--                  v-model="firstname"-->
<!--                  :rules="nameRules"-->
<!--                  :counter="15"-->
<!--                  label="Имя"-->
<!--              ></v-text-field>-->
<!--            </div>-->

<!--            <div class="form-floating mb-3">-->
<!--              <v-text-field-->
<!--                  v-model="firstname"-->
<!--                  :rules="nameRules"-->
<!--                  :counter="30"-->
<!--                  label="Фамилия"-->
<!--              ></v-text-field>-->
<!--            </div>-->

<!--            <div class="form-group registration-group">-->
<!--              <v-select-->
<!--                  v-model="select"-->
<!--                  :items="items"-->
<!--                  :error-messages="errors"-->
<!--                  label="Пол"-->
<!--                  data-vv-name="select"-->
<!--              ></v-select>-->
<!--            </div>-->

<!--            <div class="form-group registration-group">-->
<!--              <v-select-->
<!--                  v-model="select"-->
<!--                  :items="items"-->
<!--                  :error-messages="errors"-->
<!--                  label="Возраст"-->
<!--                  data-vv-name="select"-->
<!--              ></v-select>-->
<!--            </div>-->

<!--            <div class="form-group registration-group">-->
<!--              <v-input  component={InputBirthDay} name='age' class="form-select"/>-->
<!--            </div>-->

            <div>
              <button class='default-button'>
                <span>Зарегистрироваться</span>
              </button>
            </div>
          </form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";

export default {

  name: "Register",
  data() {
    return {
      form: {
        login: "",
        email: "",
        password: "",
      },
      showError: false
    };
  },
  methods: {
    ...mapActions(["Register"]),
    async submit() {
      try {
        await this.Register(this.form);
        this.$router.push("/");
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