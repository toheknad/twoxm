<template>
  <v-container fixed>
    <v-row container  justify="center" class='main-block' spacing={3}>
      <v-col item cols="8" class="main-right" style="margin-top:75px">
        <div class="paper background-sky-light profile-block-user">
            <div v-if="currentWord < countRepeatWords">
              <h4  class='paper-title-small repeat-word'>{{repeatWords[currentWord]['word']}}</h4>
              <button class='default-button btn-half btn-sky repeat-button' style="margin-bottom: 0;">
                <a class="link-for-white" >Перевод</a>
              </button>
              <button class='default-button btn-half btn-sky repeat-button'>
                <a class="link-for-white"  @click="this.nextWord">Дальше</a>
              </button>
            </div>
            <div v-else>
              <h4  class='paper-title-small repeat-word'>Поздравляю!</h4>
              <p class="">Вы повторили все слова</p>
              <button class='default-button btn-half btn-sky repeat-button '>
                <router-link  class="link-for-white" to='/dashboard'>Вернуться</router-link>
              </button>
            </div>
        </div>

      </v-col>

    </v-row>


  </v-container>

</template>

<script>
import { mapActions, mapGetters} from 'vuex'
export default {
  name: "Repeat",
  data() {
    return {
      currentWord: 0,
      countRepeatWords: 2
    }
  },
  mounted() {
    this.getWordsToRepeat()
    console.log(this.words)
  },
  computed: {
    ...mapGetters(['repeatWords']) // в песчнице эта строка выглядит как Vuex.mapState(['posts']), но в проекте такая конструкция приводит к ошибке Vuex is not defined
  },
  methods: {
    ...mapActions(['getWordsToRepeat']),
    nextWord: function () {
      this.currentWord += 1
    }
  }
}
</script>

<style scoped>

</style>