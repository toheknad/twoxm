<template>
  <v-container fixed>
    <v-row container  justify="center" class='main-block' spacing={3}>
      <v-col item cols="8" class="main-right" style="margin-top:75px">
        <div class="paper background-sky-light profile-block-user">
            <div v-if="currentWord < repeatWords.length">
              <h4  class='paper-title-small repeat-word'>{{repeatWords[currentWord]['word']}}</h4>
              <p class="repeat-word-count">Еще слов к повторению: {{repeatWords.length-currentWord}}</p>
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
import axios from "axios";
import authHeader from "@/tools/auth-api";
export default {
  name: "Repeat",
  data() {
    return {
      currentWord: 0,
    }
  },
  mounted() {
    this.getWordsToRepeat()
    console.log(this.words)
  },
  computed: {
    ...mapGetters(['repeatWords'])
  },
  methods: {
    ...mapActions(['getWordsToRepeat']),
    nextWord: function () {
      const Word = new FormData();
      Word.append("id", this.repeatWords[this.currentWord]['id']);
      axios.post('/api/repeat/save-word-as-repeated', Word, { headers: authHeader() }).then( response => {
        if (response.data) {
          console.log(response.data)
          this.currentWord += 1
        }
      })
    }
  }
}
</script>

<style scoped>

</style>