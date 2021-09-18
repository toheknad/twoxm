<template>
  <v-container fixed>
    <v-row container  justify="center" class='main-block' spacing={3}>

      <v-col item cols="5" class="main-right" style="margin-top:75px">
        <div class="paper ">
          <h4 class='paper-title-small'>Английский язык</h4>
          <form @submit.prevent="submit">
<!--            <v-autocomplete-->
<!--                clearable-->
<!--                multiple-->
<!--                small-chips-->
<!--                :items="words"-->
<!--                v-model="form.words"-->
<!--                label="Выберите слова"-->
<!--            ></v-autocomplete>-->

            <v-text-field
                label="Слово или предложение"
                v-model="form.word"
                hide-details="auto"
            ></v-text-field>
            <v-text-field
                label="Перевод"
                v-model="form.translate"
                hide-details="auto"
            ></v-text-field>

            <v-select
                :items="methods"
                v-model="form.method"
                item-text="name"
                item-value="value"
                label="Метод изучения"
            ></v-select>

          <v-btn
              color="success"
              class="mr-4"
              @click="submit"
          >
            Добавить
          </v-btn>

        </form>
        </div>
      </v-col>
      <v-col cols="7">

      </v-col>
    </v-row>

  </v-container>

</template>

<script>
import {mapActions} from "vuex";

export default {
  name: "Language",
  data () {
    return {
      form: {
        word: null,
        translate: null,
        method: '',
      },
      methods: [
        { name: 'Двухдневный', value: '1' },
        { name: 'Многоповторный', value: '2' },
      ],
      words: ['app', 'state', 'apple', 'obviuosly', 'check', 'auto'],
      values: ['foo', 'bar'],
    };
  },
  methods: {
    ...mapActions(["saveWords"]),
    async submit() {
      console.log('123');
      const Words = new FormData();
      Words.append("word", this.form.word);
      Words.append("translate", this.form.translate);
      Words.append("method", this.form.method);
      console.log(Words);
      try {
        await this.saveWords(Words);
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