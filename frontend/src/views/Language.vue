<template>
  <v-container fixed>
    <v-row container  justify="center" class='main-block' spacing={3}>

      <v-col cols="12"  md="5" sm="12" xs="12" class="main-right" style="margin-top:75px">
        <div class="paper ">
          <h4 class='paper-title-small'>Английский язык</h4>
          <p v-if="this.showError"  style="text-align: left;color: red;">Ошибка при добавлении слова!</p>
          <form @submit.prevent="submit">

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

            <v-row justify="center">
              <v-dialog
                  v-model="dialog"
                  persistent
                  max-width="404"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                      color="success"
                      dark
                      v-bind="attrs"
                      v-on="on"
                  >
                    Добавить
                  </v-btn>
                </template>
                <v-card >
                  <v-card-title class="text-h5">
                    Что дальше?
                  </v-card-title>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="green darken-1"
                        text
                        @click="submit(true)"
                    >
                      Учить слова
                    </v-btn>
                    <v-btn
                        color="green darken-1"
                        text
                        @click="submit(false)"
                    >
                      Добавить еще слово
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-row>
        </form>
        </div>
      </v-col>
      <v-col cols="12"  md="7" sm="12" xs="12">
        <div v-if="this.form.method == 1" class="description-method">
          <h1>Двухдневный метод</h1>
          <p>С помощью него слово изучается за два дня</p>
          <p>Всего повторений будет 4</p>
          <p>первое повторение — сразу по окончании чтения;<br>
            второе повторение — через 20 минут после первого повторения;<br>
            третье повторение — через 8 часов после второго;<br>
            четвёртое повторение — через 24 часа после третьего.
          </p>
        </div>
        <div v-else-if="this.form.method == 2" class="description-method">
          <h1>Интервальный метод</h1>
          <p>Если нужно помнить очень долго</p>
          <p>Всего повторений будет 4</p>
          <p>первое повторение — сразу по окончании чтения;<br>
            второе повторение — через 20—30 минут после первого повторения;<br>
            третье повторение — через 1 день после второго;<br>
            четвёртое повторение — через 2—3 недели после третьего;<br>
            пятое повторение — через 2—3 месяца после четвёртого повторения.
          </p>
        </div>
        <div v-else class="description-method">
          <h1>Выберите метод</h1>
          <p><b>Интервальный</b> - если нужно помнить очень долго</p>
          <p><b>Двухдневный</b> - если мало времени в запасе</p>
        </div>
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
      dialog: false,
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
      showError: false
    };
  },
  methods: {
    ...mapActions(["saveWords"]),
    async submit(toRepeat) {
      console.log('123');
      this.dialog = false;
      const Words = new FormData();
      Words.append("word", this.form.word);
      Words.append("translate", this.form.translate);
      Words.append("method", this.form.method);
      console.log(Words);
      try {
        await this.saveWords(Words);
        this.form = {}
        this.showError = false
        if (toRepeat) {
          this.$router.push("/repeat");
        }
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